<?php

namespace Gestion\ArticlesBundle\Tests\Entity ;

use Gestion\ArticlesBundle\Entity\Articles ;

class ArticlesTest extends \PHPUnit_Framework_TestCase{
    
    private $chaineTest = "article";
    private $floatTest = 23.4;
    
    
    
    public function testNom() {
        $article = $this->configTest();
        $this->assertInstanceOf('Gestion\ArticlesBundle\Entity\Articles', $article);
        $this->assertEquals($this->chaineTest, $article->getNom() );
        
    }
    
    public function testPrix() {
        $article = $this->configTest();
        $this->assertEquals($this->floatTest, $article->getPrixHt() );
        
    }
    
    public function testTaxe() {
        $article = $this->configTest();
        $this->assertEquals($this->chaineTest, $article->getDesignation() );
        
    }
    public function testCat() {
        $article = $this->configTest();
        $this->assertEquals($this->chaineTest, $article->getDesignation() );
        
    }
    public function testDesignation() {
        $article = $this->configTest();
        $this->assertEquals($this->chaineTest, $article->getDesignation() );
        
    }
    
    
    
    public function configTest(){
        
        $taxe = new \Gestion\ArticlesBundle\Entity\Taxes('testTaxe', 23); 
        $categorie = new \Gestion\ArticlesBundle\Entity\categories('testCategorie'); 
        
        
        $article = new Articles($this->chaineTest, $this->floatTest, $taxe, $categorie);
        $article->setDesignation($this->chaineTest);
        
        
        
        return $article;
        
         
    }
    
    
    
    
}
