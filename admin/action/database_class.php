<?php
    session_start();
    class Database{

        private $con;
        private $db_host="localhost";
        private $db_user="root";
        private $db_password="";
        private $db_name="course_enrollment";

        //Database Connection
        private function db_connection(){
            $this->con=new mysqli($this->db_host,$this->db_user,$this->db_password,$this->db_name);
            $this->con->set_charset('utf-8');
        }

        //Insert Data
        protected function insert_data($tbl,$val){
            $this->db_connection();
            $sql="INSERT INTO ".$tbl." VALUES(".$val.")";
            $this->con->query($sql);
            $this->last_id();
        }

        //Last ID
        function last_id(){
            return $this->con->insert_id;
        }

        //Update​Data
        protected function update_data($tbl,$val,$cond){
            $this->db_connection();
            $sql="UPDATE ".$tbl." SET ".$val." WHERE ".$cond."";
            $this->con->query($sql);
        }

        //Select Data
        protected function select_data($field,$tbl,$cond,$od,$limit){
            $this->db_connection();
            $data = [];
            $sql = "SELECT ".$field." FROM ".$tbl." WHERE ".$cond." ORDER BY ".$od." LIMIT ".$limit."";
            $result=$this->con->query($sql);
            $num=$result->num_rows;
            if ($num==0){
                return '0';
            }else{
                while ($row=$result->fetch_array()){
                    $data[]=$row;
                }
                return $data;
            }
        }

        //Select Duplicate Name
        protected function duplicate_data($field,$tbl,$cond){
            $this->db_connection();
            $sql="SELECT ".$field." FROM ".$tbl." WHERE ".$cond."";
            $result=$this->con->query($sql);
            $num=$result->num_rows;
            if ($num>0){
                return true;
            }else{
                return false;
            }
        }

        //Select Auto ID
        protected function get_autoID($field,$tbl,$od){
            $this->db_connection();
            $sql = "SELECT ".$field." FROM ".$tbl." ORDER BY ".$od."";
            $result=$this->con->query($sql);
            if ($result->num_rows>0){
                $row=$result->fetch_array();
                return $row[0];
            }else{
                return 0;
            }
        }

        //Count Data
        protected function count_data($tbl,$cond){
            $this->db_connection();
            $sql = "SELECT COUNT(*) AS total FROM ".$tbl." WHERE ".$cond."";
            $result=$this->con->query($sql);
            if ($result->num_rows>0){
                $row=$result->fetch_array();
                return $row[0];
            }
            return 0;
        }

        //Function Get Current Data
        protected function get_current_data($field, $tbl, $cond){
            $this->db_connection();
            $sql="SELECT ".$field." FROM ".$tbl." WHERE ".$cond."";
            $result=$this->con->query($sql);
            $row=$result->fetch_array();
            return $row;
        }


        //Log In
        function log_in($username,$password){
            $this->db_connection();
            $sql="SELECT * FROM user WHERE username='".$username."' AND password='".$password."' AND status=1";
            $result=$this->con->query($sql);
            $num=$result->num_rows;
            if ($num > 0){
                $row=$result->fetch_array();
                $msg['login']='1';
                $_SESSION['userID']=$row[0];
                $_SESSION['username']=$row[1];
            }else{
                $msg['login']='0';
            }
            echo json_encode($msg);
        }

        //Real Escape string
        function real_string($str){
            $this->db_connection();
            return $this->con->real_escape_string($str);
        }

    }

?>