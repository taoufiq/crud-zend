<?php

class Application_Form_Album extends Zend_Form
{

    public function init()
    {
        $this->setName('album');

        $artiste = new Zend_Form_Element_Text('artiste');
        $artiste->setLabel("Artiste:")
        		 ->setAttrib('class', 'text fl')
              	 ->setRequired(true)
              	 ->addFilter('StripTags')
              	 ->addFilter('StringTrim')
              	 ->addValidator('NotEmpty');
        
        $titre = new Zend_Form_Element_Text('titre');
        $titre->setLabel("Titre:")
		        ->setAttrib('class', 'text fl')
		        ->setRequired(true)
		        ->addFilter('StripTags')
		        ->addFilter('StringTrim')
		        ->addValidator('NotEmpty');
              	 
        $envoyer = new Zend_Form_Element_Submit('envoyer');
        $envoyer->setAttrib('class', 'submit fr');

        $this->addElements(array($artiste, $titre, $envoyer));
    }


}

