<?php

  declare(strict_types=1);
  
  class Tache{

    private int $id;
    private string $libelle;
    private DateTime $date;
    private int $effectuer;

    //CONSTRUCTEUR
      
    public function __construct(string $libelle, DateTime $date, int $effectuer)
    {
        $this->id = 0;
        $this->libelle = $libelle;
        $this->date = $date;
        $this->effectuer = $effectuer;
    }

    //SETTER

    public function setLibelle(String $lib){
        $this->libelle = $lib;
    }

    public function setDate(DateTime $Date){
        $this->date = $Date->format('Y-m-d');
    }

    public function setEffectuer(int $Eff){
        $this->effectuer = $Eff;
    }

    //GETTER

    public function getLibelle(){
        return $this->libelle;
    }

    public function getdate(){
        return $this->date->format('Y-m-d');
    }

    public function getEffectuer(){
        return $this->effectuer;
    }

    public function __toString()
    {
        return "Tache :{$this->libelle}  , Date : {$this->date->format('d/m/Y')}";
    }

    
  }

 

?>


