<?php
    include ('database_class.php');
    class sub_databaseClass extends Database{

        //Insert Data
        function insertData($tbl,$val){
            return $this->insert_data($tbl,$val);
        }

        //Update Data
        function updateData($tbl,$val,$cond){
            return $this->update_data($tbl,$val,$cond);
        }

        //Duplicate Data
        function duplicateData($field,$tbl,$cond){
            return $this->duplicate_data($field,$tbl,$cond);
        }

        //Select Data
        function selectData($field,$tbl,$cond,$od,$limit){
            return $this->select_data($field,$tbl,$cond,$od,$limit);
        }

        //Get Auto ID
        function getAutoID($field,$tbl,$od){
            return $this->get_autoID($field,$tbl,$od);
        }

        //Count Data
        function countData($tbl,$cond){
            return $this->count_data($tbl,$cond);
        }

        //Get Current Data
        function get_currentData($field,$tbl,$cond){
            return $this->get_current_data($field,$tbl,$cond);
        }

    }
?>