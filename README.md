
<style>
   #first h1{
     color: cyan;
     text-align: center;
   }
   
   #second h1{
     
     color: cyan;
     text-align: center;

   }
   
   #third h1 {
     color: cyan;
     text-align: center;

   }
   
</style>

<div id="first">
<h1>PoopItem</h1>

<h3>What is this weird thing?</h3>
<p>This is a pocketmine plugin for minecraft bedrock. <br/>
I created this plugin because im bored. <br/>
This plugin will activate everytime you sneak in-Game </p>

<ul>
<li>Go to config.yml and change the setting to what you needed <br/>You can do /psetting [set || list ] [setting name] [true || false] in game to change the setting in config.yml<br/>[setting name] and [true || false] doesnt require if you do !psetting list<br/>For example:<br/> !psetting set armorOnly true<br/>!psetting list</li>
</ul>

</div>

<div id="second">
<!--<h1> How to use </h1>

<ul style="margin: 20px;">
<li style="margin: 20px;"> Download this plugin </li>
<li style="margin: 20px;"> Move the downloaded plugin into pocketmine plugins folder</li>
<li style="margin: 20px;"> Go to the downloaded plugin and go to config.yml and change the setting to what you needed <br/>You can do /psetting [set || list ] [setting name] [true || false] in game to change the setting in config.yml<br/>[setting name] and [true || false] doesnt require if you do !psetting list<br/>For example:<br/> !psetting set armorOnly true<br/>!psetting list</li>
<li style="margin: 20px;"> Now start/restart your server and you done.Sneak many time you want</li>
</ul>
</div>
-->
<div id="third">

<h1> Config.yml </h1>
<p>

 ```php
preventCreative: "true"
armorOnly: "false"
toolOnly: "false"
foodOnly: "false"
all: "true"
 ```
 
</p>
 
<ul>
  <li> preventCreative <br/> Description: Prevent player in creative gamemode to use this plugin <br/> Default: "true"<br/></li>
  <li> armorOnly <br/> Description: Only drop armor <br/> Default: "false"<br/></li>
  <li> toolOnly <br/> Description: Only drop tool <br/> Default: "false"<br/></li>
  <li> foodOnly <br/> Description: Only drop food <br/> Default: "false"<br/></li>
  <li> all <br/> Description: Drop everything <br/> Default: "true"</li>
</ul>

</div>