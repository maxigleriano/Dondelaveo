<?php

    namespace DAO;

    use Models\Provider as Provider;

    class ProviderDAO 
    {
        private $providerList;
        private $fileName;

        public function __construct() 
        {
            $this->fileName = "./Data/Providers.json";
        }

        public function getProvider($id)
        {
            $this->retrieveData();
            
            foreach($this->providerList as $provider)
            {
                if($provider->getId() == $id)
                {
                    return $provider;
                }
            }
            return $null;
        }

        public function getAll() 
        {
            $this->retrieveData();
            return $this->providerList;
        }

        public function retrieveData() 
        {
            $this->providerList = array();

            if(file_exists($this->fileName)) 
            {
                $jsonContent = file_get_contents($this->fileName);
                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valueArray) 
                {    
                    $provider = new Provider();
                    $provider->setId($valueArray["provider_id"]);
                    $provider->setName($valueArray["name"]);
                    $provider->setLogo($valueArray["logo"]);
                    $provider->setUrl($valueArray["url"]);


                    array_push($this->providerList, $provider);
                }
            }
        }       
    }
