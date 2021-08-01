<?php 

namespace antbag\Clear;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\event\Listener;

class main extends PluginBase implements Listener {
  
  public function onEnable(){
    
  }

  public function onCommand(CommandSender $sender, Command $cmd, String $Label, Array $args) : bool {
    
      switch($cmd->getName()){
        case "clear":
          if($sender->hasPermisson("clear.use")){
            if($sender instanceof Player){
              $this->clear($sender);
            } else {
                $sender->sendMessage("Console Shut up");
            }
          } else {
              $sender->sendMessage("u dont have permmison to run this command");
          }
      }
  return true;
  }
  
  public function clear($player){
    $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
    $form = $api->createCustomForm(function (Player $player, array $data = null){
        if($data === null){
          return true;
        }
        
        if($data[1] == true){
            $player->getInventory()->clearAll();
            $player->sendMessage("Your inventory has been cleared")
        }
        if($data[2] == true){
            $player->getArmorInventory()->clearAll();
            $player->sendMessage("Your armors have been cleared")
        }
       if($data[3] == true){
           $player->removeAllEffects();
           $player->sendMessage("")
       }
    });
    $form->setTitle("Clear Menu")
    $form->addLabel("Chose a button below!");
    $form->addToggle("Clear Inventory", false);
    $form->addToggle("Clear Armour", false);
    $form->addToggle("Clear Effects", false);
    $form->sendToPlayer($player);
    return true;
 }
  
}
