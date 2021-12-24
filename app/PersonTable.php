<?php

//mittelverbindung
	class PersonTable extends EntityTable
    {
/*
        protected function getFieldNames() {
            return array(
                "user_id",
                "email",
                "password",
                "name"
            );
        }
    */
        protected function getTableProduct() {
            return "product";
        }

        protected function getTableCategory() {
            return "product";
        }

        protected function getPrimaryKey()
        {
            return "SKU";
        }

        protected function getProductName()
        {
            return "name";
        }

        protected function getProducts()
        {
            return array(
                "ID", //wird automatisch vergeben
                "SKU", //muss angegeben werden
                "active", //wird automatisch vergeben
                "Kathegorie", // muss angegeben werden
                "Name", //muss angegeben werden
                "Produktbilder", // muss angegeben werden
                "Beschreibung", // muss angegeben werden
                "Preis", //muss angegeben werden
                "Lagerstand", //muss angegeben werden
                "Verfuegbarseit" //muss angegeben werden
            );
        }

        protected function getActive(){
            return "active";
        }





        public function get($primaryKey)
        {
            return parent::get($primaryKey);
        }

        public function getActives($primaryKey, $active)
        {
            return parent::getActive($primaryKey, $active);
        }

        public function list()
        {
            return parent::list();
        }

        public function update($data, $primaryKey)
        {
            return parent::update($data, $primaryKey);
        }

        public function create($data)
        {
            return parent::create($data);
        }

        public function delete($primaryKey)
        {
            return parent::delete($primaryKey);
        }



    }
?>