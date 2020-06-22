<?php

namespace TrenicHD;

use pocketmine\block\Sandstone;
use pocketmine\entity\Effect;
use pocketmine\entity\Villager;
use pocketmine\event\player\PlayerRespawnEvent;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDeathEvent;
use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PlayerExhaustEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;
use pocketmine\item\ItemBlock;
use pocketmine\level\particle\HeartParticle;
use pocketmine\level\Position;
use pocketmine\level\sound\AnvilFallSound;
use pocketmine\level\sound\ClickSound;
use pocketmine\level\sound\EndermanTeleportSound;
use pocketmine\level\sound\GhastShootSound;
use pocketmine\level\sound\PopSound;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacketV2;
use pocketmine\network\mcpe\protocol\RemoveObjectivePacket;
use pocketmine\network\mcpe\protocol\SetDisplayObjectivePacket;
use pocketmine\network\mcpe\protocol\SetScorePacket;
use pocketmine\network\mcpe\protocol\types\ScorePacketEntry;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use jojoe77777\FormAPI;
use pocketmine\entity\EffectInstance;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;


class Main extends PluginBase implements Listener {

    public function onLoad()
    {
        $this->getLogger()->info(TextFormat::AQUA . "Plugin EffectBlock wird Geladen....");
    }

    public function onEnable()
    {
        $this->getLogger()->info(TextFormat::GREEN . "Plugin EffectBlock aktiv!");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onDisable()
    {
        $this->getLogger()->error(TextFormat::RED . "Plugin EffectBlock wurde deaktiviert :c");
    }

    public function onCommand(CommandSender $player, Command $cmd, string $label, array $args): bool
    {
        switch ($cmd->getName()){
            case "eb":
                if ($player instanceof Player){
                    $player->sendMessage("§c===================");
                    $player->sendMessage("Lauf auf ein Redstone Block und Bekomme Heal!");
                    $player->sendMessage("§c===================");
                }
                break;
        }
        return true;
    }

    public function onMovePlayer(PlayerMoveEvent $event){
        $player = $event->getPlayer();
        $level = $this->getServer()->getDefaultLevel();
        $block = $event->getPlayer()->getLevel()->getBlock($event->getPlayer()->floor()->subtract(0, 1));
        if ($block->getId() == 152){
            $player->getLevel()->addSound(new ClickSound($player));
            $player->getLevel()->addParticle(new HeartParticle($player));
            $effekt = new EffectInstance(Effect::getEffect(6), 200, 20, false);
            $player->addEffect($effekt);
        }
        return true;

    }

}