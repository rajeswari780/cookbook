<?php

namespace Drupal\post_recipe;

use Drupal\node\Entity\Node;

class NodeCreation{

    public function __construct(
     public String $type,
     public String $node_field_title,
     public String $title,
     public String $body,
     public String $node_field_image,
     public String $image_path,
     public String $node_para_title,
     public array $para_field_id){
    
    }


    public function nodecreate(){
        $data = file_get_contents($this->image_path);
        // $image= explode('/',$this->image_path);
        $dirname = dirname($this->image_path);
        $filecount = count(glob($dirname . "*"));
        $extension = pathinfo($this->image_path, PATHINFO_EXTENSION);
        $file = file_save_data($data, "public://image_".$filecount.".". $extension);
        $node = Node::create([
                    'type' => $this->type,
                    'title' => $this->title ,
                    $this->node_field_title => $this->title,
                    $this->node_field_image => $file->id(),
                    'body' => [
                      'value' => $this->body,
                      'format' => 'full_html',
                    ],
                    $this->node_para_title => $this->para_field_id,
                  ]);
        $node->status= 1;
        $node->save();
        return $node->id();
    }
}
