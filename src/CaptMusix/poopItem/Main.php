<?php

declare(strict_types = 1);

namespace CaptMusix\poopItem;

use pocketmine\plugin\PluginBase;
use pocketmine\{
  command\Command,
  command\CommandSender,
  event\Listener,
  event\player\PlayerToggleSneakEvent,
  Player,
  item\Item,
  item\Armor,
  item\Tool,
  item\Food,
  utils\Config
};

class Main extends PluginBase implements Listener {
  private $cfg;
  private $prefix = "§b[poopItem]§r ";
  
  public function onEnable() {
    $this->getServer()->getLogger()->info("PoopItem have enabled");
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    $this->cfg = new Config($this->getServer()->getPluginPath()."poopSneak/config.yml");
    
  }
  public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool {
        $usage = $this->prefix."§4/psetting [set || list] [setting name] [true || false]";
        
      if($label === "psetting") {
  
       if(!isset($args[0])) {
         $sender->sendMessage($usage);
         return true;
       }
       
        if($args[0] === "set") {
         if(!isset($args[1]) || !isset($args[2])) {
                  $sender->sendMessage($usage);
                        return true;
               }
              
     if(!in_array($args[2],[true,false])) {
           $sender->sendMessage($usage);
          return true;
       }
       
      $exist = $this->cfg->exists($args[1]);
                        
       if(!$exist) {
       $sender->sendMessage($this->prefix."§4Setting name '".$args[1]."' not found");
          return true;
       }   
       
     if($args[1] === "all") {
      $this->update($sender,"all",$args[2]);
      } else {
        $this->update($sender,$args[1],$args[2]);
      }
      
     } 
        
        if($args[0] === "list") {
          $alls = $this->cfg->getAll();
          $result = $this->prefix."§aAvailable config:§r\n";
          
          foreach ($alls as $key => $v) {
            $result .= "- $key: $v\n";
          }
          
          $sender->sendMessage($result);
          return true;
        }
        
     }
      
           return true;
    }
       
  public function onSneak(PlayerToggleSneakEvent $e) {
    if ($e->isCancelled()) return;
    
    $player = $e->getPlayer();
    $id = Item::getCreativeItems();
    $rand = $id[array_rand($id)];
   
    $allowCreative = filter_var($this->cfg->get("preventCreative"),FILTER_VALIDATE_BOOLEAN) ?? true;
   
    $toolOnly = filter_var($this->cfg->get("toolOnly"),FILTER_VALIDATE_BOOLEAN) ?? false;
    
    $armorOnly = filter_var($this->cfg->get("armorOnly"),FILTER_VALIDATE_BOOLEAN) ?? false;
    
    $all = filter_var($this->cfg->get("all"),FILTER_VALIDATE_BOOLEAN) ?? true;
    
    $foodOnly = filter_var($this->cfg->get("foodOnly"),FILTER_VALIDATE_BOOLEAN) ?? false;
    
    // DONT DO ANYTHING WHEN CREATIVE SETTING TRUE AND PLAYER IN CREATIVE
    if($allowCreative && $player->isCreative(true)) return;
   // DONT DO ANYTHING WHEN NONE TRUE
    if (!$all && !$armorOnly && !$toolOnly && !$foodOnly ) return;
    
    
    $dropItems = [];
    if ($e->isSneaking()) {
    
      if(!$all) {
        // DROP SPECIFIC TYPE OF ITEM
        if($armorOnly) {
          foreach ($id as $item) {
            if($item instanceof Armor){
              array_push($dropItems,$item);
                 }
             }
        }
        
      if($toolOnly) {
        foreach ($id as $item) {
         if($item instanceof Tool){
            array_push($dropItems,$item);
             }
             
           }          
        }
        
      if($foodOnly) {
       foreach ($id as $item) {
         if($item instanceof Food){
          array_push($dropItems,$item);
           }
         
        } 
         
      }
        
       $player->getLevel()->dropItem($player->asVector3(), $dropItems[array_rand($dropItems)]);
              
           return true;
      } else {
      
       $player->getLevel()->dropItem($player->asVector3(), $rand);
              
      }
      
    }

  }
  
 public function update($sender,string $target,$val) {
   
   if($target == "all") {
     // If target is "all" then change other to false
     
    $setting = $this->cfg->getAll();
  
  if($val == "true") {
    
    foreach ($setting as $type => $value) {
     // Filter all and preventCreative from been set to false
    
      if($type == "all" || $type == "preventCreative") {
           continue;
      }
      
      $this->cfg->set($type,"false");
      
    }
    
    $this->cfg->set("all",$val);
    
    }
    
   } else {
     // IF THE TARGET IS NOT "ALL" ( DOESNT CHANGE "ALL" SETTING )
     $this->cfg->set("all","false");
     $this->cfg->set($target,$val);
   }
   
   $this->cfg->save();
   $sender->sendMessage($this->prefix."§aUpdated config.yml");

  }

}
