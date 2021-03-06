<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * ResourceRegistry3
 * 
 * @package     RR3
 * @author      Middleware Team HEAnet 
 * @copyright   Copyright (c) 2012, HEAnet Limited (http://www.heanet.ie)
 * @license     MIT http://www.opensource.org/licenses/mit-license.php
 *  
 */

/**
 * FederationRemover Class
 * 
 * @package     RR3
 * @subpackage  Libraries
 * @author      Janusz Ulanowski <janusz.ulanowski@heanet.ie>
 */
class FederationRemover {
   
    protected $ci;
    protected $em;


    function __construct()
    {
         $this->ci = &get_instance();
         $this->em = $this->ci->doctrine->em;
    }

    public function removeFederation(models\Federation $federation)
    {
       $aclresources = $this->em->getRepository("models\AclResource")->findBy(array('resource' => 'f_'.$federation->getId()));
       if (!empty($aclresources))
       {
           foreach ($aclresources as $a)
           {
                  $this->em->remove($a);
           }
       }
       $attreqtmp = new models\AttributeRequirements;
       $attrsrequests = $attreqtmp->getRequirementsByFed($federation);
       if(!empty($attrsrequests))
       {
           foreach($attrsrequests as $r)
           {
                $this->em->remove($r);
           }
       }
       $attrpoltmp = new models\AttributeReleasePolicies;
       $policies = $this->em->getRepository("models\AttributeReleasePolicy")->findBy(array('type'=>'fed','requester'=>$federation->getId()));
       if(!empty($policies))
       {
          foreach($policies as $p)
          {
             $this->em->remove($p);
          }
       }
       $this->em->remove($federation);
       

    }
    
}
