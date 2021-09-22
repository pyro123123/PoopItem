<?php

declare(strict_types = 1);

namespace CaptMusix\poopItem;

use pocketmine\plugin\PluginBase;
use pocketmine\ {
  event\Listener,
  event\player\PlayerToggleSneakEvent,
  Player,
  item\ItemFactory,
  item\Item
};

class Main extends PluginBase implements Listener {
  public function onEnable() {
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
  }

  public function onSneak(PlayerToggleSneakEvent $e) {
    if ($e->isCancelled()) return;
    $player = $e->getPlayer();
    $id = Item::getCreativeItems();
    $rand = $id[array_rand($id)];
    
    if ($e->isSneaking()) {
      $player->getLevel()->dropItem($player->asVector3(), $rand);
    }

  }

}