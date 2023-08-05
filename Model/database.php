    <?php

    class Database
    {
        private $host;
        private $username;
        private $password;
        private $dbname;
        private $conn;

        public function __construct()
        {
            require_once('./config/db_config.php'); //It ensures that the included file is only loaded once, even if require_once is called multiple times in different parts of the code. 
            $this->host = DB_HOST;
            $this->username = DB_USER;
            $this->password = DB_PASS;
            $this->dbname = DB_NAME;

            $this->connect();
        }
        public function connect()
        {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
            if ($this->conn->connect_error) {
                die("connection failed" . $this->conn->connect_error);
            }
        }

        public function getConnection()
        {
            return $this->conn;
        }
    }
