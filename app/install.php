<?php

if (isset($_POST['submit'])) {

$xdbhost = $_POST['dbhost'];
$xdbuser = $_POST['dbuser'];
$xdbpass = $_POST['dbpass'];
$xdbname = $_POST['dbname'];
$xpfix = $_POST['pfix'];

$xaduser = $_POST['aduser'];
$xadpass = $_POST['adpass'];


if(trim($xdbhost) == '') {
die("You need a database host.<br><br><a href='install.php'>Back</a>");
}
if(trim($xdbuser) == '') {
die("You need a database user.<br><br><a href='install.php'>Back</a>");
}
if(trim($xdbpass) == '') {
die("You need a database password.<br><br><a href='install.php'>Back</a>");
}
if(trim($xdbname) == '') {
die("You need a database name.<br><br><a href='install.php'>Back</a>");
}
if(trim($xaduser) == '') {
die("You need an admin panel username.<br><br><a href='install.php'>Back</a>");
}
if(trim($xadpass) == '') {
die("You need an admin panel password.<br><br><a href='install.php'>Back</a>");
}

// Initiate a mySQL Database Connection
try {
  $conn = new PDO("mysql:host=" . $xdbhost . ";dbname=" . $xdbname, $xdbuser, $xdbpass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  die('ERROR: ' . $e->getMessage());
}

// Create config tables
$query = "
CREATE TABLE IF NOT EXISTS ".$xpfix."config (
  sitename text NOT NULL,
  homepagegames int(11) NOT NULL,
  advert1on int(11) NOT NULL,
  advert1 text NOT NULL,
  advert2on int(11) NOT NULL,
  advert2 text NOT NULL,
  metatags text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
// Run query
try {
  $statement = $conn->prepare($query); 
  $statement->execute(); 
  
} catch(PDOException $e) {
  die('ERROR: ' . $e->getMessage());
}

// Insert config
$query = "
INSERT INTO `".$xpfix."config` (`sitename`, `homepagegames`, `advert1on`, `advert1`, `advert2on`, `advert2`, `metatags`) VALUES
('ArcadeBlocks v2 Demo', 81, 1, 'Ad1', 1, 'Ad2', '<meta name=\"description\" content=\"ArcadeBlocks v2 is a simple, fast & easy to use Arcade Script\" />\r\n<meta name=\"keywords\" content=\"arcade script 3arcade\" />');
";
// Run query
try {
  $statement = $conn->prepare($query); 
  $statement->execute(); 
  
} catch(PDOException $e) {
  die('ERROR: ' . $e->getMessage());
}

// Create games tables
$query = "
CREATE TABLE IF NOT EXISTS ".$xpfix."games (
  id int(11) NOT NULL auto_increment,
  title text NOT NULL,
  description text NOT NULL,
  plays int(11) NOT NULL,
  rating longtext NOT NULL,
  nov longtext NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
";

// Run query
try {
  $statement = $conn->prepare($query); 
  $statement->execute(); 
  
} catch(PDOException $e) {
  die('ERROR: ' . $e->getMessage());
}

//Insert 141 games
$query = "
INSERT INTO `".$xpfix."games` (`id`, `title`, `description`, `plays`, `rating`, `nov`) VALUES
(1, 'Security 2', 'Avoid the guards and traps to escape!', 0, '0', '0'),
(196, 'Pong 2000', 'Play Pong against the computer', 0, '0', '0'),
(197, 'Colors', 'This is a Simon Says game done in flash', 0, '0', '0'),
(198, 'Mashi Mario', 'Control Mario through the course', 0, '0', '0'),
(194, 'Jigsaw', 'Jigsaw game with hint', 0, '0', '0'),
(195, 'Brighton Bounty Hunter', 'Shoot all that you can see on screen', 0, '0', '0'),
(193, 'Injection Experience', 'Aims the injection needle accurately', 0, '0', '0'),
(191, 'Slacking', 'Don', 0, '0', '0'),
(192, 'Dirt Crusher', 'Take control of the dirt crusher in this sporting game', 0, '0', '0'),
(190, 'Aparatorul', 'Fly around as a bug and shoot down the enemy bugs with lasers.', 0, '0', '0'),
(189, 'Kill the Mouse', 'Try to kill the mouse by shooting in the head.', 0, '0', '0'),
(187, 'Soccer Ball', 'Keep the ball in the air as long as possible.', 0, '0', '0'),
(188, 'Blitz World Game', 'Drop bomb and create havoc in the city', 0, '0', '0'),
(185, 'Ping AI', 'remake of the classic Pong arcade game.', 0, '0', '0'),
(186, 'Net Blazer', '3-Point basketball practise', 0, '0', '0'),
(184, 'Flash Tank', 'Control the power and angle to eliminate the enemy tank.', 0, '0', '0'),
(182, 'Hotshots', 'Score as manay point as possible before the time is out', 0, '0', '0'),
(183, 'Ollie', 'This is a game where you need to jump most of the time. Avoid the bubbles as it can hurt you.', 0, '0', '0'),
(181, 'Micro Tanks', 'destroy enemy tanks using cannon ball. Multiple terrain.', 0, '0', '0'),
(179, 'Mini Game', 'Golf game with cute nicely render female player', 0, '0', '0'),
(180, 'Choose a Girl', 'Choose your favorite girls and watch her strips as you collect points by catching falling beer', 0, '0', '0'),
(177, 'Geography Game - Africa', 'Educative game that make geographic fun. This game is on Africa', 0, '0', '0'),
(178, 'The Professionals', 'Train yourself to be a professional shooter', 0, '0', '0'),
(176, 'Whaked Studio', ' Click on as many \"treasure\" as possible and try to avoid the negative objects', 0, '0', '0'),
(175, 'Lights Off', 'Its bed time! Turn off all the lights so you can go to sleep.', 0, '0', '0'),
(174, 'Appliances Run Amuck', 'Play a toaster in this funny side scroll game collecting cables and other items!', 0, '0', '0'),
(173, 'Web Racing I', 'Challenging your CPU in this mini racing', 0, '0', '0'),
(172, 'Boom Boom Volleyball', 'Beach volleyball without a ball - use bomb instead', 0, '0', '0'),
(171, 'Bakuhatsu Panic', 'Catch the bomb before it explode and destroy the city', 0, '0', '0'),
(169, 'Quick Draw', 'Shoot buster before he shoots you', 0, '0', '0'),
(170, 'Mad Cows', 'Click on the mad cows before they hide themselves', 0, '0', '0'),
(168, 'Bug', 'Push the eggs into the appropriate nest', 0, '0', '0'),
(167, 'Memory Game', 'Memory game with cute bulldog', 0, '0', '0'),
(166, 'Tetrix 2', 'Another remake of Tetris game', 0, '0', '0'),
(165, 'Smashing', 'You have to destroy all the blocks in order to advance to the next level', 0, '0', '0'),
(164, 'Minefield of Death', 'Walking into a minefield - you will have to find the right sequence of moves to escape the minefield safely', 0, '0', '0'),
(163, 'Desktop Invaders', 'Anotehr invader clone - shoot all aliens before the 3 castles are destroyed', 0, '0', '0'),
(162, 'Squeaky', 'Collect all the oil bottle', 0, '0', '0'),
(161, 'Alpha Bravo Charlie', 'Complete the missions in your trusted helicopter', 0, '0', '0'),
(160, 'Ball Revamped: Metaphysik', 'Use the arrow keys to move the ball around but beware of various changing factors such as gravity walls and shooting lasers.', 0, '0', '0'),
(159, 'Element Saga', 'Defeat the evil army of Komos and protect the historic land. There are 3 difficulties setting for this scrolling fighting game', 0, '0', '0'),
(157, 'Keep Ups 2', 'Try to keep the ball in the air as long as possible', 0, '0', '0'),
(158, 'Jurassic Pinball', 'Pinball table with Jurassic Park theme', 0, '0', '0'),
(156, 'Plinx', 'This is a unique puzzle game', 0, '0', '0'),
(155, 'Overrun', 'Orcs are attacking don.', 0, '0', '0'),
(154, 'dc8p Fishwater Challenge', 'Collect as many fish as you can in 30 seconds. Be careful of those logs mind and keep your eyes open for the rocks.', 0, '0', '0'),
(153, 'Save Them Goldfish', 'Save the goldfish out of the frying pan and put them back into the acquarium.', 0, '0', '0'),
(152, 'Egg Run', 'Bounce the egg around to collect wooden stick to pass the level', 0, '0', '0'),
(151, 'Mini Boat Race', 'Choose from 10 boats type and 12 tracks of varied difficulty in the mini boat race', 0, '0', '0'),
(150, 'Gunman Shooter 2', 'Shoot down the stick men with your sniper rifle', 0, '0', '0'),
(148, 'Blow Up', 'Bobble Bubble clone with various ball theme', 0, '0', '0'),
(149, 'Damnation Preview', 'This is a Doom remake where you have to shoot at horde of monsters', 0, '0', '0'),
(147, 'Osama Sissy Fight', 'Punch Osama in whatever way you like', 0, '0', '0'),
(146, 'Dancing Ant', 'Configure and direct how the any should react to the music', 0, '0', '0'),
(145, 'Magnetism 2', 'Use the 3 available magnets i.e. regular electro and polarity magnets to get the ball from the machine hand to the cup.', 0, '0', '0'),
(144, 'Monster Munch', 'Help the monster eat all of the falling snowflakes.', 0, '0', '0'),
(143, 'Ma Balls', 'This is a sports game done in Flash - you have to run and try to bounce the balls', 0, '0', '0'),
(142, 'Shoot 2 Cruise Control', '3rd person shooter game with a unique feature - hide behind wall and shoot when it is safe to', 0, '0', '0'),
(141, 'Chess', 'Easy flash chess game to play', 0, '0', '0'),
(140, 'Help Guide Chuck', 'Guide Chucky down the hill by moving your mouse left and right.', 0, '0', '0'),
(139, 'Bill Cosby Fun Game', 'Senseless game involving Bill Cosby - kill people on street and drag them to the cave!', 0, '0', '0'),
(138, 'Generic zombie Shoot up', 'Shoot the zombies in the tunnel', 0, '0', '0'),
(137, 'Stick RPG', 'Build up the level of your stick character in this RPG', 0, '0', '0'),
(136, 'Caterpillar Smash', 'Smash the ugly caterpillar as they appear.', 0, '0', '0'),
(135, 'Jackie Chan - Superfighter', 'Jackie Chan fighting game', 0, '0', '0'),
(134, 'Roof Top Rollers', 'Click on the instrucments to make those cats swine', 0, '0', '0'),
(133, 'Hyper Trak', 'Futuristic POD racing games with innovative power-ups', 0, '0', '0'),
(132, 'Life Buoys', 'The ship is on fire - it is upto your skill to save all the people on board', 0, '0', '0'),
(131, 'Asteroid Field', 'Destroy the asteroid before it crash on your ship', 0, '0', '0'),
(130, 'Starsky and Hutch', 'Avoid all obstacles in this simple street racing game', 0, '0', '0'),
(129, 'Ratsuk', 'Force the opponent to a position without a valid move', 0, '0', '0'),
(128, 'X-Traning', 'Avoid the bullet as long as possible', 0, '0', '0'),
(127, 'Kingdom of Gorn - Nimian', 'Guide the nimian flyer through kingdom of gorn avoiding pillars and shooting genie.', 0, '0', '0'),
(125, '2D Paintball', 'Shoot the smiley with your paintball gun', 0, '0', '0'),
(126, 'Chumps', 'Hardcore interative cartoon', 0, '0', '0'),
(32, 'Micro Life', 'Help the Micro to get food and grow up', 0, '0', '0'),
(31, 'Bean Hunter', 'Shoot the Beans as soon as they appear on screen', 0, '0', '0'),
(30, 'Bad Shadow Brothers', 'Mixing the ice with bubbles', 0, '0', '0'),
(29, 'Ultimate Crush', 'In the game of collapse blocks of the same colour are remove upon clicking. Remove as many blocks as possible in single click to get maximum score', 0, '0', '0'),
(28, 'Bard-Jump Choose Victim', 'Timed your jump nicely if not you will be paralysed by the barb wire', 0, '0', '0'),
(27, 'Whack a Boss', 'Whack the boss in this version of the classic arcade', 0, '0', '0'),
(26, 'Golf Ace', 'Get as many hole-in-ones as possible in this golf game', 0, '0', '0'),
(25, 'King Pin Bowling', 'One of the best bowling game make in Flash', 0, '0', '0'),
(24, 'Monkey Curling', 'A sports game of curling with a catch - throw the monkey!', 0, '0', '0'),
(23, 'Cubic Rubic', 'This is an online Rubic Cube done in Flash', 0, '0', '0'),
(22, 'Santa Fighter', 'Santa fighting game', 0, '0', '0'),
(21, 'Fleabag Vs Mutt', 'It is the battle between cat and dot.', 0, '0', '0'),
(20, 'Poker Machine', 'Poker slot machine', 0, '0', '0'),
(19, 'Bush vs Kerry', 'Pit the presidency candidate in this boxing game', 0, '0', '0'),
(18, 'Monster Hatch', 'Click on the eggs to hatch the monsters', 0, '0', '0'),
(17, 'Piranhas', 'Collect gold and other treasure while staying away from piranha-infested waters and other nasty creatures', 0, '0', '0'),
(16, 'Ping Pong 3D', 'Now you can play Ping Ping on your PC', 0, '0', '0'),
(15, 'Capture The Flag', 'Avoid enemies and their deadly arrows while trying ot acpture their flag and race back to your own base', 0, '0', '0'),
(14, 'Power Play', 'Score as many power play goals and points as you can within 3 minutes in this ice hockey game', 0, '0', '0'),
(13, 'Cat-Bat', 'Juggle cats using your bat to gain points', 0, '0', '0'),
(12, 'Gangsta', 'As a gang member your objective is to one day rise to the top of the underworld!', 0, '0', '0'),
(11, 'Conundrum', 'The objective is to raised all clock as quickly as possible', 0, '0', '0'),
(9, 'African Mask', 'A challenging puzzle game', 0, '0', '0'),
(10, 'Quick Brick', 'Collapse clone with 3 modes: Tournament Puzzle or Endless', 0, '0', '0'),
(8, 'Mini-Putt', '19-holes mini golf with World Tournament or Practice mode', 0, '0', '0'),
(7, 'Gravity', 'A variation of classic Moon-Lander game. This time the planet is round!', 0, '0', '0'),
(6, 'Superfighter', 'Clone of the arcade fighting game - Super Fighter', 0, '0', '0'),
(5, 'Happy Tree Friends Flippy Attack', 'The objective of this game is simple. Stay alive as long as possible. Using characters from Happy Tree Friends.', 0, '0', '0'),
(4, 'Ultimate Football', 'Play as the Quarterback in this America Football game throw passes to your teammates.', 0, '0', '0'),
(3, 'Coconut Joes', 'Use coconut in this penalty shootout game played by monkeys', 0, '0', '0'),
(2, 'Ski Run', 'Ski between the flags', 0, '0', '0'),
(199, 'Golden Shower: The Game', 'Pee on the pedestrians. Also remember to get more drinks so that you can keep on peeing', 0, '0', '0'),
(200, 'Add Like Mad', 'Don', 0, '0', '0'),
(334, 'New Car Net Racer', 'Control the car purely with mouse and cursor distance in this unique car racing game', 0, '0', '0'),
(335, 'PYUG', 'Avoid the falling snowflake', 0, '0', '0'),
(336, 'Fighting School', 'Choose to play Fano or Mao in this street fighting game', 0, '0', '0'),
(337, 'Wakeboarding XS', 'Play either the male or female character in the wakeboarding game avoiding banana boats while performing stunts', 0, '0', '0'),
(338, 'Type Masta', 'type as fast as possible in this typing game', 0, '0', '0'),
(339, 'Franks Adventure', 'Collect Porno pics and impress sexy girls in this anime RPG', 0, '0', '0'),
(340, 'Ace Of Space', 'Horizontal space shooter. Shoot as many astroids as possible', 0, '0', '0'),
(341, 'Police Bike', 'Ride on the Police Bike and catch the street gangsters', 0, '0', '0'),
(342, 'Sabotage', 'You will want to be as accurate as possible in this game. Each miss will give negative point!', 0, '0', '0'),
(343, 'Space Empires', 'Space Colony management and space conquest game', 0, '0', '0'),
(344, 'Nun Gunner', 'Veru funny game where you get to shoot at nuns', 0, '0', '0'),
(345, 'Casino - Bad Kingdom In Wald', 'This is a Casino roulette game', 0, '0', '0'),
(346, 'Mars Patrol', 'Real time strategy game that required a bit of reflex with lots of brain', 0, '0', '0'),
(347, 'Chinese Checkers', 'Chinese checker done in Flash', 0, '0', '0'),
(348, 'Crazy Sam', 'Surfing the wave and avoiding obstacles. Another fun game by Sam', 0, '0', '0'),
(349, 'Sheep Invaders', ' Galaxy clone using flying sheep', 0, '0', '0'),
(350, 'Major Slant', 'tilt the board and guide your ball to the exit point', 0, '0', '0'),
(351, 'Wheelers', 'Use Arrow keys to control the bike. To win this game you have to finish first on every tracks', 0, '0', '0'),
(352, 'Keno', 'Test your luck in this Keno game with 80 numbers', 0, '0', '0'),
(353, 'Barry Potter', 'Shoot the owls and show no mercy as Barry Potter', 0, '0', '0'),
(354, 'Goofy Gopher', 'Match all the flower before sunset', 0, '0', '0'),
(355, 'Castle Vania', 'Walk around aimlessly through a demon infested world and kill them with your chain!', 0, '0', '0'),
(356, 'Penguinoids', 'A unique recreation of the Arkanoid game. Bounce the penguin and break the blocks', 0, '0', '0'),
(357, 'Jandora', 'Sexy Jandora will fulfilled your desire', 0, '0', '0'),
(358, 'Gladiator', 'In this gladiator fighting game your aims is to destroy all challenger as a slave fighter in the Colosseum and rise to be the next Gladiatoc Champion', 0, '0', '0'),
(359, 'Naruto', 'Guide Naruto to avoid the Ninja Shuriken', 0, '0', '0'),
(360, 'Ants', 'Spary the ants with your spraycan', 0, '0', '0'),
(361, 'Insanity', 'This is an animation on the clay man that goes insane', 0, '0', '0'),
(362, 'Hover Havoc', 'This game is just like bumper car', 0, '0', '0'),
(363, 'Dedal4', 'Race the PC player to run to the end of the maze and enter the next level', 0, '0', '0'),
(364, 'Arcade Animals Super Fish', 'Collect As much treasure as possible in this cute animal game!', 0, '0', '0'),
(365, 'Infect Evolve Repeat', 'Control and evolve the virus to infect more red blood cell', 0, '0', '0'),
(366, 'The Worm Race', 'Bet on the fastest worm in the worm race', 0, '0', '0');
";

// Run query
try {
  $statement = $conn->prepare($query); 
  $statement->execute(); 
  
} catch(PDOException $e) {
  die('ERROR: ' . $e->getMessage());
}

// Insert 91 more games
$query = "
INSERT INTO `".$xpfix."games` (`id`, `title`, `description`, `plays`, `rating`, `nov`) VALUES
(124, 'XRaye', 'Swing from post to post and turn the peg in this puzzle game', 0, '0', '0'),
(122, 'The Indian Shikar', 'Just point and shoot the tiger.', 0, '0', '0'),
(123, 'Flash Golf', '3D Flash Golf game with realistic graphic', 0, '0', '0'),
(121, 'Dread Rock', 'Climb the cliff with limited tools', 0, '0', '0'),
(120, 'As Told by Ginger', 'This is a colouring book game', 0, '0', '0'),
(119, 'Indiana Jones', 'Play as Indiana Jones and try to find the the lost treasure of Pharaoh. Obviously it wont be easy and there are traps lying around just for you!', 0, '0', '0'),
(118, 'V: Force', 'V-Force is a simpel vertical shooter game', 0, '0', '0'),
(117, 'Shoot The Gatso', 'Shoot the speed camera', 0, '0', '0'),
(116, 'Alien Attack', 'Eliminate all alien ships at all cost', 0, '0', '0'),
(115, 'KYPCK', 'Your mission is to rescue 118 russion marines from the sunken submarine KYPCK using the LR5 mini sub.', 0, '0', '0'),
(114, 'Alien Final Terminator', 'Protect Earth by shooting missiles at the invading aliens!', 0, '0', '0'),
(113, 'Frogger', 'This is a real classic simple and addictive. Just help the frog to cross the street with heavy traffic', 0, '0', '0'),
(112, 'maus Force Attack', 'An aircraft shooting game with nice graphic and sound!', 0, '0', '0'),
(111, 'Alien Cave', 'try to naigate your ship for as long as possible', 0, '0', '0'),
(110, 'Animal Hunter', 'Hunting rabbit birds etc in the jungle.', 0, '0', '0'),
(109, 'Bell Boys', 'Help the bell boy to deliver their orders to the right floor by controling the elevators', 0, '0', '0'),
(108, 'Ice Berg', 'Navigate your ship to avoid the iceberg as long as you could', 0, '0', '0'),
(107, 'Shooting Targets', 'Shoot targets and score as many points as you can.', 0, '0', '0'),
(106, 'Hybrid Fighter', 'Pilot the hybrid fighter defeding against alien invasion', 0, '0', '0'),
(105, 'The Big Game', 'Get your TV to work so that you can watch the big game in this graphical adventure', 0, '0', '0'),
(104, 'Joe Barbarian', 'get Joe the barbarian to collect treasure on his journey', 0, '0', '0'),
(103, 'Zombie Killer 2072 AD', 'Kill the disgusting zombies - each take multiple shots to dispose off', 0, '0', '0'),
(102, 'Jack Hammer Rampage', 'Driving on jackhammer and going around killing rabbit.', 0, '0', '0'),
(101, 'Sarvik', '15 diamonds are hidden in the dungeons. Find them.', 0, '0', '0'),
(100, 'SM Girls', 'Dress up the naked girl with SM costumes', 0, '0', '0'),
(99, 'Tactics Core', 'It is 7 versus 6 in this tactical board game of superheroes and their super strength', 0, '0', '0'),
(98, 'Elemigrante', 'Avoid the police for as long as you possibly can!', 0, '0', '0'),
(97, 'Euro Headers 2004', 'Pick a soccer player in this soccer game', 0, '0', '0'),
(96, 'Pearl Hunt', 'This is another addictive puzzle game', 0, '0', '0'),
(95, 'Magic Balls', 'This game is similar to Bust-A-Move but it is much tougher to beat', 0, '0', '0'),
(94, 'Sonic Heroes Puzzle', 'Stack blocks and clear them with a corresponding character block. Earn bonus for combos.', 0, '0', '0'),
(93, 'Sekonda Ice Hockey', 'Play ice hockey at the Skonda Arena', 0, '0', '0'),
(92, 'Gravity Ball 2', 'Arkanoid clone with a twist - the more you bounce it the higher it go!', 0, '0', '0'),
(91, 'Squirrel Golf II', 'There is no golf ball in this golf game. A squirrel is use instead!', 0, '0', '0'),
(90, 'Miniclip Rally', 'Race around as either the Monkey (from Monkey Lander) Zed or 3 Foot Ninja. See which is the best racer of these miniclip characters', 0, '0', '0'),
(89, 'The Peg Game', 'Click a peg that can jump over another to an empty space to remove the jumped one.', 0, '0', '0'),
(88, 'The Kungfu Statesmen', 'Choose from 1 of the 3 Kungfu master and go recover the all important secret document', 0, '0', '0'),
(87, 'A Game of Halves', 'represent your country in this football match', 0, '0', '0'),
(85, 'Kill the Boss', 'This is a simple stick-man fighting game.', 0, '0', '0'),
(86, 'All Out', 'Turn all the lights on the board out using the least amount of moves and time as possible', 0, '0', '0'),
(84, 'Reventure', 'This is a side scrolling game where you control Rieland', 0, '0', '0'),
(83, 'Coball', 'Remove all balls within the time allocated', 0, '0', '0'),
(81, 'Flashblox', 'Tetris clone', 0, '0', '0'),
(82, 'Flash Strike', 'Kill as many terrorists as possible with your gun', 0, '0', '0'),
(80, 'Criminal Intent', 'Earn money by performing all the odd-jobs', 0, '0', '0'),
(79, 'Abyss', 'Remove the tiles by clicking on them before they fall down from the platform', 0, '0', '0'),
(78, 'Ah Sau', 'Roller game - time your button to get high score', 0, '0', '0'),
(77, 'Bomb Jack', 'Collect bombs and coins and avoid contacts with monsters', 0, '0', '0'),
(76, 'Spooky Hoops', 'Avoid the skeletons and collect the pumpkins so you can make a basket', 0, '0', '0'),
(75, 'Blast Your Enemies', 'Adjust the angle of your turret to blast your enemies', 0, '0', '0'),
(74, 'Gr8Racing', 'Solo Car racing game', 0, '0', '0'),
(73, 'Short Bus Rampage', 'Rampage with the bus - as the bus driver you decided to go rampage and run the bus over those annoying kids', 0, '0', '0'),
(72, 'Motocross Champions', 'Handle the bike and perform stunt over the track', 0, '0', '0'),
(71, 'Slashing Pumpkins', 'Drop knifes to hit the rolling pumpkins', 0, '0', '0'),
(69, 'Downhill Adventure', 'Sled downhill and avoid bumping into obstacles', 0, '0', '0'),
(70, 'Crazy Castle', 'Purchase various type of weapons such as crossbows pistols UZIs lasers plasma guns and more to destroy the incoming intruders', 0, '0', '0'),
(68, 'Allied Assault', 'Destroy enemy space craft and cannons in space. Pickup the rare power-up for more firepowers', 0, '0', '0'),
(66, 'Wink The Game', 'Help Wink to rescue the princess from the evil dragon', 0, '0', '0'),
(67, 'Super Monkey Poop Fight', 'Go around collect banana in this Flash game', 0, '0', '0'),
(65, 'Super Figther', 'Super Fighter is a great fighting game with nice moves', 0, '0', '0'),
(64, 'Minesweeper', 'Minesweeper in Flash and can be customised', 0, '0', '0'),
(63, 'Invasion', 'Capture the invading alien before time run out', 0, '0', '0'),
(62, 'Quix', 'Move the colour tiles to a new location. Remove tiles by placing the same colour tiles together', 0, '0', '0'),
(61, 'Monster Mahjong', 'Play mahjong against the monsters', 0, '0', '0'),
(60, 'Super Space Dog Fighting', 'Shoot the alien from within your spacecraft', 0, '0', '0'),
(59, 'Match Up', '4x4 Memory game with Korean style comic', 0, '0', '0'),
(58, 'Connect 4', 'Insert coin into the column and try to connect 4 pieces either horizontally vertically or diagonally while preventing computer from doing so', 0, '0', '0'),
(57, 'Pedestrian Killer', 'Hit as many pedestrians as possible', 0, '0', '0'),
(55, 'Etherena', 'A fighting game for 2 players that run smoothly ', 0, '0', '0'),
(56, 'Castle Cat 2', 'Play a cute cat that throw mace and fire cannon. Collect coin and avoid running over by cars', 0, '0', '0'),
(54, 'De Grote Samsamrace', 'Ride on your bicycle avoid all the obstacles along the path', 0, '0', '0'),
(53, 'Flash Life Buoys', 'Save as many people as you can from the ship', 0, '0', '0'),
(52, 'Heli Attack', 'Neat arsenals of weapon power-ups', 0, '0', '0'),
(51, 'Fuel Transport', 'Get the fuel safely to the base behind the enemy lines', 0, '0', '0'),
(50, 'World Cup Soccer Tournament', '3-a-side soccer game with multiple difficulties settings', 0, '0', '0'),
(49, 'Loft Game', 'Memory game with real photos', 0, '0', '0'),
(48, 'Race - Stay The Distance', 'Select your horse based on tips and hope it win the race for you!', 0, '0', '0'),
(47, 'Bug on a Wire', 'Stay on the wire and don', 0, '0', '0'),
(46, 'Pokemon Puzzle Challenge', 'Challenge your knowledge of Pokemon - identify the right pokemon before the time run out', 0, '0', '0'),
(45, '3D Space Skimmer', 'Fly around space', 0, '0', '0'),
(44, 'German Air Force', 'Drop bomb against the allies countries', 0, '0', '0'),
(43, 'Bird Hunting', 'Shoot all the birds on screen', 0, '0', '0'),
(42, 'Round Rong', 'Rong is simple a Circular version of Pong', 0, '0', '0'),
(41, 'Star Ambushed', 'You were attack by Imperial TIE-Fighter. Click to fire and destroy them as many as possible.', 0, '0', '0'),
(40, 'Penguin Push', 'A sokoban clone using different graphical theme', 0, '0', '0'),
(39, 'Frisbee Dog', 'Timed the position and the height and let the dog catch the frisbee', 0, '0', '0'),
(38, 'Let It Ride', 'This is one of the Casino games that make use of Poker rules', 0, '0', '0'),
(37, 'Amazing Golf Pro', 'Another mini golf with qeird control', 0, '0', '0'),
(36, 'The Global Rage', '2-players fighting game', 0, '0', '0'),
(35, 'Ninja Power', 'Use your Ninja power to attack the defender', 0, '0', '0'),
(34, 'Soccer Break Away', 'Choose a right direction to kick the ball.', 0, '0', '0'),
(33, 'Steeplechase Challenge', 'Jump and whip at the corrct timing to beat the computer controlled horses', 0, '0', '0');
";

// Run query
try {
  $statement = $conn->prepare($query); 
  $statement->execute(); 
  
} catch(PDOException $e) {
  die('ERROR: ' . $e->getMessage());
}

$query = "
INSERT INTO `".$xpfix."games` (`id`, `title`, `description`, `plays`, `rating`, `nov`) VALUES
(201, 'Astro Boy', 'Avoid hit by the asteriod and destroy it to survive', 0, '0', '0'),
(202, 'Agent K', 'Passed all 3 training mission and become a real SWAT member.', 0, '0', '0'),
(203, 'Mario Castle Shoot', 'Buy weapons and protect the castle', 0, '0', '0'),
(204, 'Trailer Park Racing 2000', 'Play this amusing racing games against a friend or the computer AI', 0, '0', '0'),
(205, 'Slider Mania', 'A sliding puzzle game', 0, '0', '0'),
(206, 'Ballons', 'Target Practise with a twist - the targets are hanging on balloons!', 0, '0', '0'),
(207, 'Sheepteroids', 'It is Sheep-teroids that we are shooting!', 0, '0', '0'),
(208, 'Lunatic', 'Avoid the little green balls that come out of the explosions', 0, '0', '0'),
(209, 'Hulk Smash Up', 'Play the incredible Hulk in this game - smash everythign with bare hands', 0, '0', '0'),
(210, 'GYR Ball', 'Control the GYR Ball in multiple terrains without falling off the boundary', 0, '0', '0'),
(211, 'Pacman', 'Another clone of the classic Pacman game', 0, '0', '0'),
(212, 'Shino Beat', 'Slash on enemies that blocked your way to their boss!', 0, '0', '0'),
(213, 'Nordic Chill', 'You have to complete all 4 winter sport events in this sports game.', 0, '0', '0'),
(214, 'Jessica Alba Bubble Bath', 'Undress Jessica Alba', 0, '0', '0'),
(215, 'Obsoleter', 'Earn points by shooting targets as much as you can in the time allocated.', 0, '0', '0'),
(216, 'Ball Breaker', 'Use the ball to hit the brick and let them disappear. When the ball fall catch it with the stick. If the ball drops you lose.', 0, '0', '0'),
(217, 'What-A-Shot', 'basketball shooting game', 0, '0', '0'),
(218, 'Insane Orb EX', 'Use your paddle to deflect the ball', 0, '0', '0'),
(219, 'City Hunter', 'Shoot your enemies as fast as possible. If they shot you 25 times you are dead.', 0, '0', '0'),
(220, 'Tetris', 'Play a great remake of the classic arcade game Tetris.', 0, '0', '0'),
(221, 'Under Construction', ' A nice platform game under contruction', 0, '0', '0'),
(222, 'Amazons vs Athenians', 'In this shooting game you are competing against other team', 0, '0', '0'),
(223, 'Keepy Uppy', 'Click on the head and score points', 0, '0', '0'),
(224, 'Hungry Bob', 'Make Bob jump only on the food he like', 0, '0', '0'),
(225, 'Kill a Kitten', 'Kill the annoying kitten with your gun', 0, '0', '0'),
(226, 'Arcade Animals Super Raccoon', 'Collect As much treasure as possible in this cute animal game!', 0, '0', '0'),
(227, 'Strip Stripp Erella', 'Dress up the naked girl Erella', 0, '0', '0'),
(228, 'Jeu Vote', ' Politics game in which the voters now become the invader and your vote is the only defense', 0, '0', '0'),
(229, 'Crash Down', 'Remove group of block if they are of the same colour', 0, '0', '0'),
(230, 'The Batman!', 'Protect Gotham City from criminals and crimes', 0, '0', '0'),
(231, 'Brewery Defender', 'Protect the brewery long enough to transport the precious beer away.', 0, '0', '0'),
(232, 'Karboom', 'Catch the bomb before it explode.', 0, '0', '0'),
(233, 'Solitaire', 'Solitaire with illustrated card face', 0, '0', '0'),
(234, 'Introduction to Sailing', 'This game is designed to teach you the fundamentals of sailboat racing.', 0, '0', '0'),
(235, 'Falling Dildos', 'Avoid the falling dildos', 0, '0', '0'),
(236, 'Perfect Match', 'Test your memory power in this matching game', 0, '0', '0'),
(237, 'Spelling Game', 'Match the alphabet to become a word.', 0, '0', '0'),
(238, 'Green and Black', 'A collection of several small games with green/black graphic', 0, '0', '0'),
(239, 'Out Of Halloween', 'It is Halloween and the pumkin head are coming from all direction', 0, '0', '0'),
(240, 'King of Buttons', 'Click the buttons as fast as you could multiple play mode!', 0, '0', '0'),
(241, 'Bowling for Nuns', 'Bowling game with nuns as the pins', 0, '0', '0'),
(242, 'Secret Robotic Defense', 'Kill all target robots', 0, '0', '0'),
(243, 'Splash', 'Throwing water balloons in the office in this light hearted 1st person shooter', 0, '0', '0'),
(244, 'Space', 'Destroy other ship gain more fuel destroy more ships gain even more fuel. ', 0, '0', '0'),
(245, 'Arkanoid Flash', 'Another Arkanoid Clone', 0, '0', '0'),
(246, 'Mars Fighter', 'Obtain powerful power-ups and devices to fight against the invading alien more effectively', 0, '0', '0'),
(247, 'Bow Man', 'Adjust your angle and power relative to the wind speed - kill your opponent before he did it to you', 0, '0', '0'),
(248, 'Rotation', 'Rotate the virus so that it form the desire pattern', 0, '0', '0'),
(249, 'Slim Boy', 'Basketball shooting game', 0, '0', '0'),
(250, 'Fishing the Sea', 'Fun fishing game. To play move the hook near the fish. Reel in the fish slowly when the fish is hooked back to your fishing boat for a catch.', 0, '0', '0'),
(251, 'Yeti Sports-Seal Bounce', 'One of the famous Yeti games. Throw the penguin as high as possible assisted by the Seals', 0, '0', '0'),
(252, 'Desert Battle', 'This is a shooting game with desert scenery. Weapons include rockets and missiles.', 0, '0', '0'),
(253, 'Cutie Quake', 'Play quake using a cute character mod', 0, '0', '0'),
(254, 'Starship Seven', 'Navigate Starship Seven home - beware as the way home is full of danger', 0, '0', '0'),
(255, 'The Drifter Decoder', 'Another Memory game with 3D graphic', 0, '0', '0'),
(256, 'Demolition Derby', 'Try to damage computer controlled cars before he did it to yours.', 0, '0', '0'),
(257, 'Sniper', 'Professional Killer pit their snipping skill in this sniper game', 0, '0', '0'),
(258, 'Gandalf (LOTR)', 'Gandy lost his pipe - so he must travel back to retrieve it. Collect gold coin along the way', 0, '0', '0'),
(259, 'Silly Golf', 'play mini golf on your desktop', 0, '0', '0'),
(260, 'Air Wolf', '1 to 1 air fighting using x-wing craft', 0, '0', '0'),
(261, 'Hate that Frog', 'Froh shooting game', 0, '0', '0'),
(262, 'Van', 'Control the Van using mouse and try to reach the airport without crashing', 0, '0', '0'),
(263, 'Steppenwolf', 'Move Steppenwolf through the world in an interactive series of action and logic based puzzle', 0, '0', '0'),
(264, 'Battleships General Quarters', 'The Classic battleship game on PC', 0, '0', '0'),
(265, 'Video Poker', 'Video poker game in Flash', 0, '0', '0'),
(266, 'Carmageddon', 'Run over as many pedestrians as possible with your car', 0, '0', '0'),
(267, 'Bubbles', 'Aboid land mines etc in this game', 0, '0', '0'),
(268, 'Dizzy Paul', 'Paul is dizzy and he need to collect the capsule to goto next level', 0, '0', '0'),
(269, 'America Strikes Back', 'Go throught 3 different levels (Water Air and Ground) in this game', 0, '0', '0'),
(270, 'The Phantom Penis', 'Adult interactive cartoon', 0, '0', '0'),
(271, 'Stackopolis MC', 'You have limited time to stack up the tiles as per the blueprint. Successful and you will construct a structure in the city. ', 0, '0', '0'),
(272, 'Combat Instinct', 'You are being exposed to extreme radiation. Find a Decontamination chamber within 200 seconds.', 0, '0', '0'),
(273, 'Creepy Crossword', 'This is a crossword puzzle in Flash', 0, '0', '0'),
(274, 'Creepy Cave', 'Guide Shaggy and Scooby from the cartoon/movie through a graphical adventure', 0, '0', '0'),
(275, '24 Puzzle', 'A 3D puzzle game. The objective is to align the number 1 to 24', 0, '0', '0'),
(276, 'Alien Invasion', 'A desparate alien species is trying to sek refuge on Earth however it was not welcome on Earth and the order from the President is to destroy them all', 0, '0', '0'),
(277, 'Beer Golf', 'Mini Golf with beer bottle as obstacles', 0, '0', '0'),
(278, 'Bomb Pearl Harbour', 'Bomb the ship and shoot the US fighters', 0, '0', '0'),
(279, 'Flash Mind', 'Flash version of the Master Mind game', 0, '0', '0'),
(280, 'Batting Champ', 'Baseball batting game with realistic 3D character rendering', 0, '0', '0'),
(281, 'Jungle Crash', 'Remove pieces by matching at least 3 of the same kind', 0, '0', '0'),
(282, '2D Air Hockey', 'Play against the computer AI In Air Hocket on your desktop', 0, '0', '0'),
(283, 'The Adventures Of Bibo 2', 'Help Bilbo the monkey to gain access to the SMF camp', 0, '0', '0'),
(284, 'Avenger', 'Protect the city by piloting the Avenger', 0, '0', '0'),
(285, 'Alien Clones', 'Attack the enemy walker in this fast pace game', 0, '0', '0'),
(286, 'Bojo', 'Collect the bombs before they explode. You only have 5 lives', 0, '0', '0'),
(287, 'Xiao Xiao 1', 'Zhu created a series of funny animation titled Xiao Xiao and this is the first in series', 0, '0', '0'),
(288, 'Street Fighter', 'Street Fighter clone in Flash', 0, '0', '0'),
(289, 'Swordsman', 'Kill the ninja warrior as the swordman', 0, '0', '0'),
(290, '2 Ball Pool', 'In this pool game there are only 1 pocket!', 0, '0', '0'),
(291, 'Sneaky Thief Adventure', 'This is a tough game of maze. You have to sneak into the castle and steal treasures.', 0, '0', '0'),
(292, 'Kill the Pacman', 'Jump on top of pacman to kill the pacman stay in mid air to kill as many Pacman as quickly as possible', 0, '0', '0'),
(293, 'Kick Off', 'Penalty shootup game with 5-levels. You will be the playing as both player and goal keeper', 0, '0', '0'),
(294, 'Ewoks', 'Shoot the annoying little teddy bear. You must earn at least 400 points in order to advance to the next level.', 0, '0', '0'),
(295, 'Tommy Tooth', 'Shoot the virus to protect the teeth', 0, '0', '0'),
(296, 'Fruit Machine', 'Pull the lever on this slot machine and win some big money', 0, '0', '0'),
(297, 'The Tower of Hanoi', 'Move the pile to another location. Click on a number to set the height of the pile.', 0, '0', '0'),
(298, 'Holy Cow', 'Before you can enter the holy gates of heaven you must perform a number of good deeds by helping the depressed', 0, '0', '0'),
(299, 'Gun Down The Gungan', 'Kill as many Gungun as possible within the time limit', 0, '0', '0'),
(300, 'Pet Puzzle', '4x4 Puzzle of Pet images', 0, '0', '0'),
(301, 'Techno Bounce', 'You have to use the blocks to keep the ball bouncing in the air', 0, '0', '0'),
(302, 'Weight Throw', 'Use your magic wand to throw the weight as far as possible', 0, '0', '0'),
(303, 'King Ping Pong', 'Play table tennis on PC', 0, '0', '0'),
(304, 'Monster Bash', 'Help Bob Bolt clear the place of the pesky monster by directing Rasper to jump on them', 0, '0', '0'),
(305, 'Pipes', 'Place a pipe segment on an empty location. Pick up a pipe segment and place it from here to there.', 0, '0', '0'),
(306, 'Starfighter', 'Keep shooting the wave after waves of enemy spacecrafts.', 0, '0', '0'),
(307, 'Aqua Field', 'Guide the fish to their food and avoiding dangerous objects', 0, '0', '0'),
(308, 'Bush Bash', 'It is the Presidential Debate and you are the moderator', 0, '0', '0'),
(309, 'Ping Pong', 'This is another version of Pong', 0, '0', '0'),
(310, 'Memory Family Guy', 'Flip over the cards and memorize the characters in this memory game', 0, '0', '0'),
(311, 'Startwars', 'Fight again the infamous Ultraman in this cute fighting game', 0, '0', '0'),
(312, 'Free Mars', 'Shoot the martian before they kill you', 0, '0', '0'),
(313, 'Galactic Tennis', 'Play air hocket with alien races', 0, '0', '0'),
(314, 'Flesh Fight', 'This game have no time limit. You may blast as many enemies as you wish but do not let them hit you. They can smash you too.', 0, '0', '0'),
(315, 'Fly Pig', 'Shoot down the flying pigs using shotgun. Make nice sandwich with the dead pigs meat', 0, '0', '0'),
(316, 'Flying Squirrel', 'Move the flying squirrel around in order to collect points.', 0, '0', '0'),
(317, 'Alpha Force', 'Shoot down all the enemy aircraft before they destroy you in Alpha Force', 0, '0', '0'),
(318, 'Coloring the Mouse', 'A Flash colouring book', 0, '0', '0'),
(319, 'Sinjid Shadow Of The Warrior', 'Fujin train Sinjid to fight the Fallen Army', 0, '0', '0'),
(320, 'Samurai Asshole', 'You master died at a dinner held by the three religious leaders. You must avenge his death. The three religious will have to die.', 0, '0', '0'),
(321, 'Road Rage', 'Just hit as many pedestrians even cows as possible', 0, '0', '0'),
(322, 'Blackjack', 'This is a nice Blackjack games that allow playing upto 5 hands at once', 0, '0', '0'),
(323, 'Counterstrike', '1st Person shooter using graphic from the Counter Strike games', 0, '0', '0'),
(324, 'Monster Mash', 'Somehow Tatertown is infested with undead. As the hero in this game head to the graveyard with your gun to stop them at their home.', 0, '0', '0'),
(325, 'Amok Madman', 'Target shooting at the can. How best can you perform under the influence of alcohol?', 0, '0', '0'),
(326, 'Alien Abduction', 'You are the alien. You mission: abduct the right people/animal and send them back to your mothership', 0, '0', '0'),
(327, 'The Great Escape', 'Educative game to teach about importance of calcium intake', 0, '0', '0'),
(328, 'Twiddlestix', 'A puzzle game that required quick reflex', 0, '0', '0'),
(329, 'Metroid Genesis', ' Use the password hunted to start the game', 0, '0', '0'),
(330, 'Chio', 'Guide all snakes out of the room', 0, '0', '0'),
(331, 'Lift', 'Identify the character before the lift door closes', 0, '0', '0'),
(332, 'Evangelion - Pac Man', 'Guide Shinji around the city taking pills and defeating enemies. It is actually a pacman clone with characters from Evangelion anime series', 0, '0', '0'),
(333, 'Kill Fred Durst', 'Kill Fred Durst with 11 methods', 0, '0', '0'),
(367, 'Balloony', 'Shoot anything that moved on your screens', 0, '0', '0');
";

// Run query
try {
  $statement = $conn->prepare($query); 
  $statement->execute(); 
  
} catch(PDOException $e) {
  die('ERROR: ' . $e->getMessage());
}

$filec = fopen("admin/config.php", "w");

$strText = '<?php
// This is the config file for the 3arcade script. You should not
// need to change this file unless you are moving server.

//==============================
// Site variables:
$admin_user = "'.$xaduser.'";   //admin panel username
$admin_pass = "'.$xadpass.'";   //admin panel password

//==============================
// Database variables:
$dbhost = "'.$xdbhost.'";       // Database Server
$dbuser = "'.$xdbuser.'";       // Database User
$dbpass = "'.$xdbpass.'";       // Database Pass
$dbname = "'.$xdbname.'";       // Database Name
$tbprefix = "'.$xpfix.'";       //Table Prefix
$db_error_mode = 1;             // 1 = show DB error, 0 = show $db_error_message
$db_error_message = "Problem connecting to database.";  // Message to show if $db_error_mode = 0

//==============================
// Initiate a mySQL Database Connection
try {
    $conn = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "ERROR: " . $db_error_mode ? $e->getMessage() : $db_error_message;
}

// Load settings from DB row
try {
    $query = "SELECT * FROM ".$tbprefix."config";
    $statement = $conn->prepare($query); 
    $statement->execute(); 
    // Use fetch to pick up first row
    $settings = $statement->fetch();
    
} catch(PDOException $e) {
    echo "ERROR: " . $db_error_mode ? $e->getMessage() : $db_error_message;
}
//==============================
?>';

fputs($filec, $strText); 
		fclose($filec);

		
		
die("3arcade has been successfully installed!<br><br><b>It is VERY important you remove install.php immediately.</b>");
		
}
?><style type="text/css">
<!--
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px; font-weight: bold; }
.style3 {font-size: 14px; font-family: Verdana, Arial, Helvetica, sans-serif;}
-->
</style>
<p class="style2">3arcade Installation</p>
<p class="style3">Thanks for purchasing the 3arcade script.</p>
<p class="style3">Please make sure you have read the readme.txt included before proceeding with the installation.</p>
<p class="style3">---------------------</p>
<p class="style3">Before installing, you should have done the following things:</p>
<p class="style3">1. Upload the upload directory.</p>
<p class="style3">2. CHMOD 777 (full rights) the /content directory and any subdirectories.</p>
<p class="style3">3. CHMOD 777 (full rights) the /admin/config.php file (not the whole directory).</p>
<p class="style3">4. Have SQL database login details ready.</p>
<p class="style3">----------------------</p>
<form id="form1" name="form1" method="post" action="install.php">
<p class="style3">Database Host: 
  <input name="dbhost" type="text" id="dbhost" value="localhost" />
</p>
<p class="style3">Database User:
  <input name="dbuser" type="text" id="dbuser" />
</p>
<p class="style3">Database Password:
  <input name="dbpass" type="password" id="dbpass" />
</p>
<p class="style3">Database Name:
  <input name="dbname" type="text" id="dbname" />
</p>
<p class="style3">Table Prefix :
  <input name="pfix" type="text" id="pfix" value="3a_" />
</p>
<p class="style3">----</p>
<p class="style3">Admin Username: 
  <input name="aduser" type="text" id="aduser" />
</p>
<p class="style3">Admin Password:
  <input name="adpass" type="password" id="adpass" value="" />
</p>
<p class="style3">(The admin panel can be found at <?php



	$scr_n_n = $_SERVER["SCRIPT_NAME"];
		
		$scr_n_n = substr($scr_n_n, 0, -12);
		
		  print "http://" . $_SERVER["HTTP_HOST"] . $scr_n_n . "/admin";



?>)</p>
<p class="style3">
<input type="submit" value="Install" border="0" name="submit" height="17" width="40" /></form>
<p class="style3">----</p>