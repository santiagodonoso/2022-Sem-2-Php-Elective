<?php
class SurrealConn {

    private $headers;
    private $auth;
    private $host;
    private $simplify;

    public function __construct($db) {
        // VALIDATE $DB ARR IS SET
        if (
            !$db['user']        ||
            !$db['password']    ||
            !$db['host']        ||
            !$db['database']    ||
            !$db['name_spacing']
        ) return;

        // BUILD CONNECTION OBJECT
        $this->headers = [
            'Content-Type: application/json',
            'Accept: application/json', 
            'ns: '.$db['name_spacing'],
            'db: '.$db['database']
        ];
        $this->auth = $db['user'] . ':' . $db['password'];
        $this->host = $db['host'] . ':' . $db['port'] . '/sql' ;
        // Go directly to "result" or not
        if ($db['no_bullshit']) $this->simplify=True;
        else $this->simplify=False;
    }


    public function execute($query, $vars = '') {
        // CREATE SECURE QUERY IF VARS/PLACEHOLDERS ARE SET
        if ($vars) {
            $query = self::sanitise_query($query, $vars);
        }

        $ch = curl_init($this->host);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1); //timeout in seconds
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Do not output the response automatically on exec
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, $this->auth);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        if(!$response = curl_exec($ch)){
          throw new Exception('Cannot connect to SurrealDB');
        } // ENTER
        curl_close($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if( ! $http_code ){ throw new Exception('timeout'); }
        $response = json_decode($response, true); // the response as assosiative array
        if( isset($response['code']) && $response['code'] != 200 ){ throw new Exception($response['information']); }
        // The no bullshit response:
        if ( $this->simplify ) return $response[0]['result'];
        return end($response);
    }

    private function sanitise_query($query, $vars) {
        // Verify that amount of ? and amount of vars match 
        if (substr_count($query, '?') !== count($vars)) return;

        // Create query from placeholders and vars
        $vars_count = count($vars);
        $idx = 0;
        while ($idx < $vars_count) {
            $q_idx = strpos($query, '?');
            $query = substr_replace($query, '"' .$vars[$idx] . '"', $q_idx, 1);
            $idx ++;
        }

        return $query;
    }
}