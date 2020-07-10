<?php

namespace SeedPlanter;

use pocketmine\event\Listener;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\plugin\PluginBase;
use pocketmine\block\Block;

class Main extends PluginBase implements Listener
{


    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function seedPlanter(BlockBreakEvent $event)
    {
        $item = $event->getItem();
        $block = $event->getBlock();
        $player = $event->getPlayer();
        if ($item->getId() == 414) {
            if ($player->getInventory()->contains($beetroot = Item::get(458, 0, 9))) {
                $player->getInventory()->removeItem(clone $beetroot);
                $this->setPlant($block, 244);
            }
            ///////////////////////////
            if ($player->getInventory()->contains($wheat = Item::get(295, 0, 9))) {
                $player->getInventory()->removeItem(clone $wheat);
                $this->setPlant($block, 59);
            }
            ///////////////////////////
            if ($player->getInventory()->contains($carrots = Item::get(141, 0, 9))) {
                $player->getInventory()->removeItem(clone $carrots);
                $this->setPlant($block, 141);
            }
            ///////////////////////////
            if ($player->getInventory()->contains($potato = Item::get(142, 0, 9))) {
                $player->getInventory()->removeItem(clone $potato);
                $this->setPlant($block, 142);
            }
            ///////////////////////////
            if ($player->getInventory()->contains($pumpkim = Item::get(361, 0, 9))) {
                $player->getInventory()->removeItem(clone $pumpkim);
                $this->setPlant($block, 104);
            }
            ///////////////////////////
            if ($player->getInventory()->contains($melon = Item::get(362, 0, 9))) {
                $player->getInventory()->removeItem(clone $melon);
                $this->setPlant($block, 105);
            }
            $event->setCancelled(true);
        }
    }

    public function setPlant(Block $block, $id)
    {
        $minposx = $block->getX() - 1;
        $maxposx = $block->getX() + 1;
        $minposz = $block->getZ() - 1;
        $maxposz = $block->getZ() + 1;
        for ($x = $minposx; $x <= $maxposx; $x++) {
            for ($z = $minposz; $z <= $maxposz; $z++) {
                $terre = $block->getLevel()->getBlockAt($x, $block->getY(), $z);
                if ($terre->getId() === 3) {
                    $block->getLevel()->setBlock(new Vector3($x, $block->getY(), $z), Block::get(60, 0));
                    $block->getLevel()->setBlock(new Vector3($x, $block->getY() + 1, $z), Block::get($id, 1), false, false);
                }
                if ($terre->getId() === 2) {
                    $block->getLevel()->setBlock(new Vector3($x, $block->getY(), $z), Block::get(60, 0));
                    $block->getLevel()->setBlock(new Vector3($x, $block->getY() + 1, $z), Block::get($id, 1), false, false);

                }
            }
        }
    }
}