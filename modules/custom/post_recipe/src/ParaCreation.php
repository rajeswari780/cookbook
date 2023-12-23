<?php

namespace Drupal\post_recipe;

use Drupal\paragraphs\Entity\Paragraph;

class ParaCreation{

    public function __construct(
        public String $para_type,
        public String $para_field,
        public String $para_value,){
       
       }

    public function createPara(){
        $paragraph =  Paragraph::create([
                    'type' => $this->para_type,
                    $this->para_field => array(
                      "value"  =>  $this->para_value,
                      "format" => "full_html"
                    ),
                  ]);
        $paragraph->save();
        
        $para_id = ['target_id' => $paragraph->id(),
                    'target_revision_id' => $paragraph->getRevisionId(),];
        
        return $para_id;

    }
}