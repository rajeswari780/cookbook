<?php

namespace Drupal\post_recipe\Form;

use Drupal\Core\Form\FormStateInterface; 
use Drupal\Core\Form\FormBase;
use Drupal\file\Entity\File;
use Drupal\post_recipe\NodeCreation;
use Drupal\post_recipe\paraCreation;
use Drupal\menu_link_content\Entity\MenuLinkContent;
use Drupal\Core\url;
use Symfony\Component\HttpFoundation\RedirectResponse;
use \Drupal\Core\Messenger\MessengerInterface;

class post_recipe extends FormBase{

    public function getFormId(){
        return "post_recipe";
    }
    /**
     * {@inheritdoc}
     * 
     */
    public function buildForm(array $form, FormStateInterface $form_state){


        $form['recipe_list']=[
            '#type' => 'select',
            '#title' => t('Choose your crusine'),
            '#required' => TRUE,
            '#options' => array(t('--- SELECT ---'), t('Indian'), t('French'), t('Thai')),
        ];
        
        $form['title']=[
            '#type' => 'textfield',
            '#title' => t('Recipe Title'),
            '#required' => TRUE,
        ];
        $form['recipe_image']=[
            '#type' => 'managed_file',
            '#title' => $this->t('Recipe Image'),
            '#upload_location' => 'public://custom/directory',
            '#upload_validators' => [
              'file_validate_extensions' => ['jpg','png','jpeg'],
            ],
        ];
        $form['ingredients']=[
            '#type' => 'textarea',
            '#title' => t('Recipe Ingredients'),
            '#required' => TRUE,
        ];
        $form['recipe_method']=[
            '#type' => 'textarea',
            '#title' => t('Recipe Steps'),
            '#required' => TRUE,
        ];
        $form['submit']=[
            '#type' => 'submit',
            '#value' => t('Post'),
            '#button_type' => 'primary',
        ];
        return $form;
    }
     /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
   

  }
    /**  
    * {@inheritdoc}  
    */  
    public function submitForm(array &$form, FormStateInterface $form_state) { 

        $title = $form_state->getValue('title');
        $body = $form_state->getValue('recipe_method');
        $ingredients = $form_state->getValue('ingredients');


        $image_file = $form_state->getValue('recipe_image', 0);
        if (isset($image_file[0]) && !empty($image_file[0])) {
          $file = File::load($image_file[0]);
          $file->setPermanent();
          $file->save();
          $name = $file->getFilename();
        }
        $image_path = 'http://localhost:8012/drupal_site/sites/default/files/custom/directory/'.$name;


        switch($form_state->getValue('recipe_list')){
          case 1: $type = 'indian_dish'; 
                  $paratype = 'indian_recipe';
                  $parafield = 'field_indian_ingrediants';
                  $node_field_title = 'field_india_title';
                  $node_field_image ='field_india_image';
                  $node_para_title = 'field_indian';
                  $left_nav = 4;
                  break;
          case 2: $type = 'french_dish'; 
                  $paratype = 'french_recipe';
                  $parafield = 'field_french_ingredients';
                  $node_field_title = 'field_french_title';
                  $node_field_image ='field_french_recipe';
                  $node_para_title = 'field_fre';
                  $left_nav = 6;
                  break;
          case 3: $type = 'thai_dish'; 
                  $paratype = 'thai';
                  $parafield = 'field_thai_ingredients';
                  $node_field_title = 'field_thai_title';
                  $node_field_image ='field_thai_image';
                  $node_para_title = 'field_thai_recipe';
                  $left_nav = 5;
                  break;
        }

        $paracreate = new ParaCreation($paratype,$parafield,$ingredients);
        $paracreate = $paracreate->createPara();

        $nodecreate = new NodeCreation($type,$node_field_title,$title,$body,$node_field_image,
                $image_path,$node_para_title,$paracreate);
        $nodecreate = $nodecreate->nodecreate();

        $menu_links = \Drupal::entityTypeManager()->getStorage('menu_link_content')
        ->loadByProperties(['id'=> $left_nav]);
        foreach($menu_links as $menu_link){
            $link = $menu_link->getPluginId();
        }
        MenuLinkContent::create([
          'title' => $title,
          'link' => ['uri' => 'internal:/node/'.$nodecreate],
          'menu_name' => 'l',
          'parent' => $link,
          'weight' => 0,
        ])->save();

        // $routeName = 'entity.node.canonical';
        // $routeParameters = ['node' => $nodecreate];
        // $url = \Drupal::url($routeName, $routeParameters);
        // return new RedirectResponse($url);

        $url = Url::fromRoute('entity.node.canonical', ['node' => $nodecreate]);
        $form_state->setRedirectUrl($url);

        \Drupal::messenger()->addMessage(t($title.' recipe is posted successfully. Thank you for your Contribution.'));

    }
}