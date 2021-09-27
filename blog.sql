-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 27, 2021 at 06:01 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id17634079_blog`
--
CREATE DATABASE IF NOT EXISTS `id17634079_blog` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `id17634079_blog`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Business, Finance & Economics'),
(2, 'Computers, Science & Technology'),
(3, 'Entertainment, Art & Culture'),
(4, 'General News & Current Affairs'),
(5, 'Health & Medicine'),
(6, 'Lifestyle'),
(7, 'Multicultural Press'),
(8, 'New Zealand'),
(9, 'Sport & Leisure'),
(10, 'Trade & Professional');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `comment_date` datetime NOT NULL DEFAULT current_timestamp(),
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `comment_date`, `post_id`, `user_id`) VALUES
(5, 'very good article, keep going', '2021-09-26 02:57:27', 24, 21),
(6, 'Good article, Keep going Ramy. I want to read more from you', '2021-09-26 03:23:27', 29, 21);

-- --------------------------------------------------------

--
-- Table structure for table `comment_likes`
--

CREATE TABLE `comment_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comment_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `like_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment_likes`
--

INSERT INTO `comment_likes` (`id`, `comment_id`, `user_id`, `like_date`) VALUES
(1, 6, 5, '2021-09-26 03:24:25'),
(2, 6, 21, '2021-09-26 04:39:06');

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `follower_id` bigint(20) UNSIGNED NOT NULL,
  `following_id` bigint(20) UNSIGNED NOT NULL,
  `follow_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `like_date` datetime NOT NULL DEFAULT current_timestamp(),
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `like_date`, `post_id`, `user_id`) VALUES
(7, '2021-09-26 03:20:16', 24, 21);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(1000) NOT NULL,
  `content` longtext NOT NULL,
  `image` varchar(1000) NOT NULL,
  `publish_date` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `image`, `publish_date`, `created_at`, `updated_at`, `category_id`, `user_id`) VALUES
(22, 'Pennytel acquires Focus Communications', 'Acquisition of Focus Communications\r\n\r\nPennytel Holdings Pty Limited (Pennytel) is pleased to announce the acquisition of Focus Communications Pty Limited (Focus Communications). The acquisition of Focus Communications adds to the expanding customer base and team at Pennytel.\r\n\r\n\r\nFocus Communications has operated in the Telecommunications B2B space since 1999 and brings a wealth of experience to the Pennytel Team.\r\nPennytel has acquired three companies in the last 12 months, this acquisition is strategically important as it will allow Pennytel be a more effective competitor to challenge the major network operators by integrating fixed line, internet, and mobile businesses.', 'https://online.hbs.edu/Style%20Library/api/resize.aspx?imgpath=/PublishingImages/blog/posts/Accounting_Tools.jpg&w=750&h=375', '2021-09-26 03:38:27', '2021-09-26 01:42:22', NULL, 1, 24),
(23, 'Compexica AI to Power South Australia\'s Largest Port', 'Complexica Pty Ltd, a leading provider of Artificial Intelligence software for supply & demand optimisation, announced today that it has signed a contract with Flinders Port Holdings (FPH) for the deployment of Complexica\'s award-winning Artificial Intelligence engine –Larry, the Digital Analyst® . FPH will use the engineto assist with optimising yard operations at the Flinders Adelaide Container Terminal (FACT) at Outer Harbor. The primary objective of the software deployment will be to optimise the movement and handling of containers arriving or departing from the yard by vessel, train, and truck, as well as the movement of containers within the yard and their allocation to straddles.\r\n\r\n“We have selected one of Australia’s leading Artificial Intelligence software companies for this important project to maximise the efficiency and capacity of our yard operations at FACT”, said Keith Halifax, Chief Financial Officer of FPH. “The use of Complexica’s Artificial Intelligence software will allow the port to run a 24/7 optimisation process that will dynamically improve container movements and handling, leading to increased throughput in the port.', 'https://i2.wp.com/www.edupristine.com/wp-content/uploads/2018/06/basic-accounting.jpg', '2021-09-26 03:42:27', '2021-09-26 01:42:22', NULL, 1, 24),
(24, 'A new way to solve the ‘hardest of the hard’ computer problems', 'A relatively new type of computing that mimics the way the human brain works was already transforming how scientists could tackle some of the most difficult information processing problems.\r\n\r\nNow, researchers have found a way to make what is called reservoir computing work between 33 and a million times faster, with significantly fewer computing resources and less data input needed.\r\n\r\nIn fact, in one test of this next-generation reservoir computing, researchers solved a complex computing problem in less than a second on a desktop computer.\r\n\r\nUsing the now current state-of-the-art technology, the same problem requires a supercomputer to solve and still takes much longer, said Daniel Gauthier, lead author of the study and professor of physics at The Ohio State University.\r\n\r\n\"We can perform very complex information processing tasks in a fraction of the time using much less computer resources compared to what reservoir computing can currently do,\" Gauthier said.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/bf/Computer-science-education.jpg/1200px-Computer-science-education.jpg', '2021-09-26 05:46:35', '2021-09-26 01:49:05', NULL, 2, 21),
(25, 'Taking lessons from a sea slug, study points to better hardware for artificial intelligence', 'For artificial intelligence to get any smarter, it needs first to be as intelligent as one of the simplest creatures in the animal kingdom: the sea slug.\r\n\r\nA new study has found that a material can mimic the sea slug\'s most essential intelligence features. The discovery is a step toward building hardware that could help make AI more efficient and reliable for technology ranging from self-driving cars and surgical robots to social media algorithms.\r\n\r\nThe study, publishing this week in the Proceedings of the National Academy of Sciences, was conducted by a team of researchers from Purdue University, Rutgers University, the University of Georgia and Argonne National Laboratory.\r\n\r\n\"Through studying sea slugs, neuroscientists discovered the hallmarks of intelligence that are fundamental to any organism\'s survival,\" said Shriram Ramanathan, a Purdue professor of materials engineering. \"We want to take advantage of that mature intelligence in animals to accelerate the development of AI.\"\r\n\r\nTwo main signs of intelligence that neuroscientists have learned from sea slugs are habituation and sensitization. Habituation is getting used to a stimulus over time, such as tuning out noises when driving the same route to work every day. Sensitization is the opposite -- it\'s reacting strongly to a new stimulus, like avoiding bad food from a restaurant.\r\n\r\n', 'https://www.vinu.edu/documents/10181/5193090/5004.jpg/28cf052a-9ecf-eeb3-1928-e8afc9b22670?version=1.0&t=1579102461703&download=true', '2021-09-26 03:52:35', '2021-09-26 01:49:05', NULL, 2, 21),
(26, 'The Tragedy of Macbeth review – McDormand and Washington deliver noirish nightmare', 'what’s the point of another Macbeth movie? It wasn’t that long ago we had Justin Kurzel’s big realist version, with Michael Fassbender and Marion Cotillard. Well, there’s always a point if the film is as compelling and visually brilliant as this. Director Joel Coen, working for once without brother Ethan, has delivered a stark monochrome nightmare, refrigerated to an icy coldness.\r\n\r\nWith Shakespeare’s text cut right back, it’s a version that brings us back to the language by framing the drama in theatrical, stylised ways: an agoraphobic ordeal in which bodies and faces loom up with tin-tack sharpness out of the creamy-white fog.', 'https://i.guim.co.uk/img/media/9bcff4eec49c7feee6dd9217973d8f280f99396d/0_627_3765_2260/master/3765.jpg?width=1020&quality=85&auto=format&fit=max&s=30c046ffac035721a48d7481c7a5fc0e', '2021-09-26 03:49:42', '2021-09-26 01:53:13', NULL, 3, 6),
(27, '‘A culture wars lightning rod’: exit Craig, enter a panic over woke Bond', 'I always joke, how many Bond fans does it take to change a lightbulb?” said Ajay Chowdhury, spokesperson for the James Bond international fan club, the oldest established 007 fan organisation in the world. “One. But 10 to complain how much better the original was.”\r\n\r\nAs Daniel Craig’s incarnation of Bond draws to a close with the release of No Time to Die next week, rumours over who will replace him have reached fever pitch.\r\n\r\nBut this time, the customary speculation over the next Bond has become embroiled in culture war skirmishes and “wokery” panic. As campaigners call for producers to pick a woman or a black actor, traditionalists fear cinema’s most iconic spy could be the next “victim of woke”.', 'https://i.guim.co.uk/img/media/d2d8244306cd0f02f59c150f3a705492ec0af0a6/0_71_3504_2103/master/3504.jpg?width=620&quality=85&auto=format&fit=max&s=aa46b051ff09a7d3850de74f8ef0c59a', '2021-09-26 03:49:51', '2021-09-26 01:53:13', NULL, 3, 6),
(28, 'Secretary-General’s Address to the General Assembly', 'Mr. President of the General Assembly, Excellencies,\r\n\r\nI am here to sound the alarm:  The world must wake up.\r\n\r\nWe are on the edge of an abyss — and moving in the wrong direction.\r\n\r\nOur world has never been more threatened.\r\n\r\nOr more divided.\r\n\r\nWe face the greatest cascade of crises in our lifetimes. \r\n\r\nThe COVID-19 pandemic has supersized glaring inequalities. \r\n\r\nThe climate crisis is pummeling the planet.\r\n\r\nUpheaval from Afghanistan to Ethiopia to Yemen and beyond has thwarted peace.\r\n\r\nA surge of mistrust and misinformation is polarizing people and paralyzing societies, and human rights are under fire. \r\n\r\nScience is under assault.  \r\n\r\nAnd economic lifelines for the most vulnerable are coming too little and too late — if they come at all.\r\n\r\nSolidarity is missing in action — just when we need it most. \r\n\r\nPerhaps one image tells the tale of our times. \r\n\r\nThe picture we have seen from some parts of the world of COVID-19 vaccines … in the garbage.  \r\n\r\nExpired and unused.   \r\n\r\nOn the one hand, we see the vaccines developed in record time — a victory of science and human ingenuity.\r\n\r\nOn the other hand, we see that triumph undone by the tragedy of a lack of political will, selfishness and mistrust. \r\n\r\nA surplus in some countries.  Empty shelves in others.\r\n\r\nA majority of the wealthier world vaccinated.  Over 90 percent of Africans still waiting for their first dose.\r\n\r\nThis is a moral indictment of the state of our world.\r\n\r\nIt is an obscenity. \r\n\r\nWe passed the science test. \r\n\r\nBut we are getting an F in Ethics.\r\n\r\nExcellencies,\r\n\r\nThe climate alarm bells are also ringing at fever pitch.\r\n\r\nThe recent report of the Intergovernmental Panel on Climate Change was a code red for humanity. \r\n\r\nWe see the warning signs in every continent and region.\r\n\r\nScorching temperatures.  Shocking biodiversity loss.  Polluted air, water and natural spaces. \r\n\r\nAnd climate-related disasters at every turn.\r\n\r\nAs we saw recently, not even this city — the financial capital of the world — is immune. \r\n\r\nClimate scientists tell us it is not too late to keep alive the 1.5 degree goal of the Paris Climate Agreement. \r\n\r\nBut the window is rapidly closing.\r\n\r\nWe need a 45 per cent cut in emissions by 2030.  Yet a recent UN report made clear that with present national climate commitments,  emissions will go up by 16% by 2030. \r\n\r\nThat would condemn us to a hellscape of temperature rises of at least 2.7 degrees above pre-industrial levels – a catastrophe.\r\n\r\nMeanwhile, the OECD just reported a gap of at least $20 billion in essential and promised climate finance to developing countries.\r\n\r\nWe are weeks away from the UN Climate Conference in Glasgow, but seemingly light years away from reaching our targets.\r\n\r\nWe must get serious.  And we must act fast. ', 'https://global.unitednations.entermediadb.net/assets/mediadb/services/module/asset/downloads/preset/Libraries/Production+Library/21-09-2021-UN-Photo-UN81823-Guterres.jpg/image350x235cropped.jpg', '2021-09-26 03:53:21', '2021-09-26 01:56:10', NULL, 4, 5),
(29, 'News in Brief 14 July 2021', 'The outgoing head of the UN team investigating crimes committed by the ISIL terror network in Iraq, was in New York this week to give his final report to the Security Council where he delivered “clear” evidence of genocide. \r\n\r\nKarim Khan, Special Adviser and head of UNITAD, said there was some way to go before justice is done on behalf of the victims of crimes – such as the Yazidis - that “rip at the soul of humanity”.  Matt Wells began by asking him to summarize the report’s findings. ', 'https://global.unitednations.entermediadb.net/assets/mediadb/services/module/asset/downloads/preset/Libraries/Production+Library/23-04-2021_-SOS_Mediterranee-migrants-02.jpg/image350x235cropped.jpg', '2021-09-26 04:59:21', '2021-09-26 01:56:10', NULL, 4, 5),
(30, 'Delta variant of SARS-CoV-2: Can vaccine boosters stop its spread?\r\nThe Delta variant of ', 'The Delta variant of SARS-CoV-2, the virus that causes COVID-19, is more transmissible than preexisting variants, and it has rapidly become the dominant variant in several countries, including India and the United Kingdom. Some reports suggest that existing COVID-19 vaccines may be less effective in preventing infection with Delta. Can additional booster shots help?\r\n\r\nAll data and statistics are based on publicly available data at the time of publication. Some information may be out of date. Visit our coronavirus hub and follow our live updates page for the most recent information on the COVID-19 pandemic.\r\n\r\nOver the past few months, the Delta variant of SARS-CoV-2 has spread widely in countries around the world, becoming the dominant variant in many places.', 'https://i0.wp.com/post.medicalnewstoday.com/wp-content/uploads/sites/3/2021/08/GettyImages-1234489615_thumb-732x549.jpg?w=304', '2021-09-26 03:56:18', '2021-09-26 01:59:19', NULL, 5, 23),
(31, 'How can we prevent the spread of SARS-CoV-2 in children?', 'Children are being hospitalized with COVID-19 in record numbers across the United States. As most children are not old enough to get vaccinated, hospitalizations could further increase as schools reopen. Doctors and epidemiologists are thus calling for the use of safety precautions, such as masks and ventilation, during class.', 'https://i0.wp.com/post.medicalnewstoday.com/wp-content/uploads/sites/3/2021/08/GettyImages-1269827972_thumb-732x549.jpg?w=304', '2021-09-26 04:13:18', '2021-09-26 01:59:19', NULL, 5, 23),
(32, 'Breaking up, but living together: how lockdowns lead to ‘nesting’', 'fter 12 years with her husband, Lisa* left her marital bed. She did not have far to go. Locked down in Melbourne, she moved into her daughter’s bedroom. “It’s not huge, our house, but big enough so that if one person was in one bedroom and one in the other, there was enough distance between us,” she says.\r\n\r\nBefore the Covid-19 pandemic hit, Lisa and her husband had been attending marriage counselling with a view to seperate, but when the world shut down, they found it “very difficult to do that online”.\r\n\r\nUltimately, coinciding with the first lockdowns in March 2020, the pair finalised their decision, but amid the uncertainties of the pandemic, they wanted to retain a stable home environment for their three children, who are of pre- and primary-school age. This led them to “nesting” – where a couple breaks up, but remains living together.\r\n\r\nSydney-based divorce lawyer Cassandra Kalpaxis says she has been inundated with inquiries about nesting since lockdowns began. “There’s definitely a lot of confusion out there in relation to moving houses if there has been separation,” she says.\r\n\r\nArabella Feltham, who works as a separation consultant for the Separation Guide online resource, has had a similar experience. “I have seen a definite increase in people discussing nesting with me. They have done a lot of their own research, asking me, ‘is this a viable option to help de-escalate and keep things amicable?’ What people are trying to do is keep the children as undisrupted as they can, keep them in the family home.”', 'https://i.guim.co.uk/img/media/72d0fb84b74efbb91fd7054bdd1051ae054faaec/0_0_1717_1145/master/1717.png?width=620&quality=85&auto=format&fit=max&s=14ac6eb2102be3059f271f5630b9bfc1', '2021-09-26 04:00:57', '2021-09-26 02:03:58', NULL, 6, 6),
(33, 'Can we talk to aliens? And should we colonise space? We ask the expert', 'For years, astrophysicists have been saying that alien life must exist, but finding out where and in what form has proved elusive. We may be edging closer: a team from the University of Cambridge has discovered a new class of habitable planets they claim will lead to evidence of life in the next three years. Is ET out there? Or is this search, like that for the holy grail, more about us than them? I asked Jacco van Loon, astrophysicist and director of Keele Observatory in Staffordshire, for his opinion.\r\n\r\nHi Jacco! Explain your job as though I were five years old.\r\nI study stars, and the space between them. Space is relatively empty, but not completely.', 'https://i.guim.co.uk/img/media/e8deaf144a7aa48f0eb85e946b88c5f8b23e8c4b/0_0_5000_2926/master/5000.jpg?width=1020&quality=85&auto=format&fit=max&s=c1767acb74b31507c42f48bfa8eea515', '2021-09-26 04:05:57', '2021-09-26 02:03:58', NULL, 6, 6),
(34, '\r\n This article is more than 3 years old\r\nThe Guardian view on multicultural Britain: learning to live together', 'It is depressing to discover that four in 10 adults in this country agreed with the statement that “having a wide variety of backgrounds and cultures has undermined British culture”. After all, such mainstays of British culture as curry, the Notting Hill carnival and bearded Muslim sports heroes were at one time all viewed as inimical to it. Cultures are dynamic things, developing organically from communities. They do not exist in isolation or remain static. Having a range of cultures in Britain is normal, not novel.\r\n\r\nIf so, then why are so many still resistant? There is a straightforward economic analysis: austerity has shrunk the space we might share, be that schools, parks or hospitals, while growing inequalities supply people with new opportunities to scapegoat minorities. Then there is a barrage of claims about a government policy of encouraging cultural difference at the expense of national cohesion. There is no state-led segregation policy today. British governments are not in the habit of sacrificing the nation on the altar of imaginary cultural preferences. Yet years of anger stoked around this falsehood found, unfortunately, an outlet in the Brexit referendum.', 'https://i.guim.co.uk/img/media/c7e5d293e02e61ae547a097e0a0ba68032e72710/0_368_5514_3308/master/5514.jpg?width=620&quality=85&auto=format&fit=max&s=5ec44ce6472519c13a5d34c1d88a8af9', '2021-09-26 04:04:06', '2021-09-26 02:06:29', NULL, 7, 22),
(35, 'Andrew Bolt\'s \'virus thrives in multiculturalism\' columns offensive, press council says', 'Andrew Bolt has received a rap over the knuckles from the Australian Press Council for attributing the spread of the coronavirus in Melbourne to multiculturalism. Two columns were found to have breached two press council rules: one for ensuring that factual material is balanced and fair and one for not causing substantial offence, distress or prejudice.\r\n\r\nIn June last year the Herald Sun columnist wrote: “Victoria’s coronavirus outbreak exposes the stupidity of that multicultural slogan ‘diversity makes us stronger’. Oh, really? It’s exactly that diversity – taken to extremes – that’s helped to create this fear of a second wave.”', 'https://i.guim.co.uk/img/media/2b0dd3ad61431912356566263f95f0138e89c9e3/6_178_3514_2109/master/3514.jpg?width=620&quality=85&auto=format&fit=max&s=1e414bd8d511b97eab2944ad79cafaf0', '2021-09-26 04:04:22', '2021-09-26 02:06:29', NULL, 7, 22),
(36, '\r\nJack Grealish finds a different rhythm to dance Chelsea into submission', 'There were four minutes to play as Jack Grealish left the pitch. Manchester City were still deep in the boiler room, seeing out a 1-0 lead in a game they had for long periods dominated to a strangulating degree. But there was time still for a round of hand-clasps, back-pats and buttock slaps, the most significant from his replacement Raheem Sterling, who had sat for 85 minutes watching Grealish produce a quiet masterpiece on the flank that had been Sterling’s own private strip of turf for long periods last season.\r\n\r\nThere was nothing from Pep Guardiola, although Grealish did sneak an eager, lingering look at the maniacal figure in black, who was at that moment caught up with whirling his arms and barking out assorted thoughts, ideas, tweaks, fears, counter-theories.', 'https://i.guim.co.uk/img/media/2fa593ec700560dceff2027d71e02bdef6a5b3be/0_344_5472_3283/master/5472.jpg?width=620&quality=85&auto=format&fit=max&s=876c2b7a1547ec14cfbdfc6a9321c5ba', '2021-09-26 04:06:37', '2021-09-26 02:08:58', NULL, 9, 22),
(37, 'Liverpool held to thrilling draw at Brentford after Wissa grabs his chance', 'At the final whistle, Jürgen Klopp could not stop shaking his head in disbelief. Somehow his Liverpool side had contrived to throw away victory against a Brentford side that simply never stopped believing.\r\n\r\nWhile Klopp can console himself with the fact that they are a point clear at the top after Mohamed Salah scored his 100th Premier League goal for the club, he will know his defence must improve considerably as their weaknesses were exposed time and again. Salah would certainly have sealed the victory had he not spurned a golden opportunity when his side were leading 3-2 but this was all about the pulsating performance from Thomas Frank’s new boys that sparked into life with Ethan Pinnock’s opener and was rounded off by Yoane Wissa’s equaliser eight minutes from time.', 'https://i.guim.co.uk/img/media/1db0067a7ed2dfbb9aaee09a9a8ba41505298c34/0_150_4070_2443/master/4070.jpg?width=620&quality=85&auto=format&fit=max&s=cba98a35ef4654465705397bf59209b0', '2021-09-26 04:08:59', '2021-09-26 02:08:58', NULL, 9, 22),
(38, 'China sends jets and bombers near Taiwan as Beijing opposes island’s trade deal bid', 'China has voiced opposition to Taiwan joining a major trans-Pacific trade deal as it flew 24 planes – including two nuclear-capable bombers – into the self-ruled island’s air defence zone, the biggest incursion in weeks, Taiwanese officials said.\r\n\r\nLast week Beijing submitted its own application to become a member of the Comprehensive and Progressive Agreement for Trans-Pacific Partnership (CPTPP).', 'https://i.guim.co.uk/img/media/84a94f957cc8d00c7a02714a0a7b62af0b1228d6/267_0_5655_3394/master/5655.jpg?width=620&quality=85&auto=format&fit=max&s=0eb0f2d8a3a13a493a3adfa2a0e8ee73', '2021-09-26 04:09:06', '2021-09-26 02:11:34', NULL, 10, 24),
(39, '\r\nBritain’s hopes of early post-Brexit trade deal with US appear dashed', 'Britain’s hopes of a post-Brexit trade deal with the US have all but evaporated barring a dramatic change of heart from Joe Biden, it emerged on Tuesday as Boris Johnson held face-to-face talks in the White House.\r\n\r\nJohnson once regarded a bilateral free trade agreement with the US as a key Brexit win, highlighting the prospects for British exporters unfettered from the EU. But government insiders privately concede that they see little prospect of progress towards a one-to-one deal, as the Biden administration focuses on other priorities.', 'https://i.guim.co.uk/img/media/cd448a6dc41769dc8ba552cb40204ed8656f1b68/393_710_4523_2714/master/4523.jpg?width=700&quality=85&auto=format&fit=max&s=064c8c3f3150dd0a00c29890540a53dc', '2021-09-26 04:13:06', '2021-09-26 02:11:34', NULL, 10, 23);

-- --------------------------------------------------------

--
-- Table structure for table `post_tags`
--

CREATE TABLE `post_tags` (
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post_tags`
--

INSERT INTO `post_tags` (`post_id`, `tag_id`) VALUES
(22, 12),
(23, 12),
(23, 13),
(23, 18),
(24, 7),
(24, 8),
(25, 5),
(25, 15),
(26, 9),
(27, 19),
(28, 10),
(29, 12),
(30, 14),
(31, 12),
(31, 14),
(32, 17),
(32, 21),
(33, 12),
(33, 24),
(34, 10),
(35, 13),
(35, 14),
(36, 21),
(36, 22),
(37, 12),
(37, 21),
(38, 6),
(38, 23),
(39, 9),
(39, 17);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(5, 'Accounting'),
(6, 'Banking & Finance'),
(7, 'Biotechnology & Life Science'),
(8, 'Computers & IT Business'),
(9, 'Art & Culture'),
(10, 'Books & Literature'),
(11, 'Current Affairs/Features'),
(12, 'General News'),
(13, 'Fitness & Wellbeing'),
(14, 'Health Informatics'),
(15, 'Adventure & Outdoors'),
(16, 'Animals & Pets'),
(17, 'Multicultural Press - African'),
(18, 'Multicultural Press - Chinese'),
(19, 'NZ - Agriculture'),
(20, 'NZ - Advertising, Marketing & Media'),
(21, 'Football League'),
(22, 'Basketball'),
(23, 'Architecture & Design'),
(24, 'Automotive Trade');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(500) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `phone`, `type`, `active`) VALUES
(5, 'Ramy Ibrahim', 'admin', '202cb962ac59075b964b07152d234b70', 'ramymibrahim@yahoo.com', NULL, 1, 1),
(6, 'ahmed mohamed', 'ahmed.mohamed', '202cb962ac59075b964b07152d234b70', 'ahmed.mohamed@yahoo.com', '01000000000', 0, 1),
(21, 'Mahmoud Mamdouh', '7ouda', '202cb962ac59075b964b07152d234b70', 'mahmoud.khalil1072@gmail.com', '01091122383', 0, 1),
(22, 'Moustafa Mamdouh', 'sasa', '202cb962ac59075b964b07152d234b70', 'moustafa@gmail.com', '01012121212', 0, 1),
(23, 'Mohamed Ahmed Hassan', 'fakharany', '202cb962ac59075b964b07152d234b70', 'mohamed@gmail.com', '011212145461', 0, 1),
(24, 'Omar Essam', 'oEssam', '202cb962ac59075b964b07152d234b70', 'omaressam@gmail.com', '01204542104', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `posts_post_id_fk` (`post_id`),
  ADD KEY `user_user_id_fk` (`user_id`);

--
-- Indexes for table `comment_likes`
--
ALTER TABLE `comment_likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `comments_comment_likes_fk` (`comment_id`),
  ADD KEY `users_comment_likes_fk` (`user_id`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `users_follow_id_fk` (`follower_id`),
  ADD KEY `users_following_id_fk` (`following_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `users_likes_user_id_fk` (`user_id`),
  ADD KEY `posts_likes_post_id_fk` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `categories_category_id_fk` (`category_id`),
  ADD KEY `users_user_id_fk` (`user_id`);

--
-- Indexes for table `post_tags`
--
ALTER TABLE `post_tags`
  ADD PRIMARY KEY (`post_id`,`tag_id`),
  ADD KEY `tags_post_tags_tag_id_fk` (`tag_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `email_UI` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comment_likes`
--
ALTER TABLE `comment_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `posts_post_id_fk` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment_likes`
--
ALTER TABLE `comment_likes`
  ADD CONSTRAINT `comments_comment_likes_fk` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_comment_likes_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `users_follow_id_fk` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_following_id_fk` FOREIGN KEY (`following_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `posts_likes_post_id_fk` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_likes_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `categories_category_id_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `users_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post_tags`
--
ALTER TABLE `post_tags`
  ADD CONSTRAINT `posts_post_tags_post_id_fk` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tags_post_tags_tag_id_fk` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
