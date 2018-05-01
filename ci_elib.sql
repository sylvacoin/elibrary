-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2018 at 07:15 PM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_elibrary`
--
CREATE DATABASE IF NOT EXISTS `ci_elibrary` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ci_elibrary`;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
  `contact_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ucontact_id` int(11) NOT NULL,
  `date_added` int(11) NOT NULL,
  `contact_req_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'contact request status allows a user to make request to share materials with another contact. 0 = Made request , 1 = Accepted request. if request is rejected it is deleted from the list.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`contact_id`, `user_id`, `ucontact_id`, `date_added`, `contact_req_status`) VALUES
(1, 8, 8, 14, 1),
(2, 8, 11, 14, 1),
(3, 8, 10, 14, 1),
(4, 8, 9, 14, 1),
(5, 11, 10, 15, 0),
(6, 11, 9, 15, 0);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
CREATE TABLE `documents` (
  `doc_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `type_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `tags` longtext NOT NULL,
  `author` varchar(50) DEFAULT NULL,
  `edition` varchar(50) DEFAULT NULL,
  `access_level` enum('everyone','specific','private') NOT NULL DEFAULT 'everyone',
  `access_ids` text,
  `is_pswd` tinyint(1) NOT NULL DEFAULT '0',
  `pswd` varchar(40) DEFAULT NULL,
  `url` varchar(300) NOT NULL,
  `screenshot_path` varchar(100) DEFAULT NULL,
  `file_size` varchar(40) NOT NULL,
  `orig_name` varchar(100) NOT NULL,
  `enc_name` varchar(100) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `date_added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`doc_id`, `user_id`, `cat_id`, `type_id`, `title`, `tags`, `author`, `edition`, `access_level`, `access_ids`, `is_pswd`, `pswd`, `url`, `screenshot_path`, `file_size`, `orig_name`, `enc_name`, `is_deleted`, `date_added`) VALUES
(2, NULL, 5, 1, 'Jawa Assingment (Rancho Solution)1', '\r\n \r\n \r\n \r\n \r\n\r\nProgramming Language 1 \r\n\r\nAssignment \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n\r\nClick on the Exercise to jump to destination Exercise \r\n \r\n\r\n\r\nYou can RUN those program in \r\n\r\n\r\nyour system. \r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\n\r\nQUESTIONS  \r\nExercise 1 \r\n Answer No: (1) (2)  (3)  (4)  \r\nExercise 2 \r\n Answer No: (8) (9)  (10)  (11)  (12) \r\nExercise 3 \r\n Answer No: (1) (2)  (3)  (4) \r\nExercise 4 \r\n Answer No: (1) \r\nExercise 7 \r\n Answer No: (1) (8)  (10) \r\nExercise 8 \r\n Answer No: (1) (3)  (4) \r\nExercise 12 \r\n Answer No: (1) (2)  (3) \r\n \r\n \r\n \r\n \r\n \r\n \r\n \n\r\nExercise 1. \r\n(1) Using an illustration explain the four features of an \r\nalgorithm. \r\nIllustration: \r\n1. Deterministic  - e.g 4 + 5 = 9 OR 11 + 11 = 22. \r\nAlways the same no matter what. \r\n2. Finite - e.g Solving the problem of graduating from \r\nschool OR Solving the problem of traveling from one \r\nplace to another. It must be completed in a finite amount \r\nof time. \r\n3. Scheduled - e.g The process of cooking food OR the \r\nprocess of making cake. This will run over a series of \r\nsteps it is scheduled to the next step. \r\n4. Effective - e.g The problem of getting to Onitsha from \r\nEnugu. \r\n \r\n(2) In producing an algorithm, there are three main phases \r\nimplementation, development and maintenance. List \r\nthe stages in the three phases. \r\nAnswers \r\nReference Page 2  \r\n \r\n(3) Assuming you are the adviser to the governor on youth \r\nmatters. Produce an algorithm to solve youth \r\nunemployment in Anambra State using the steps \r\noutlined above. \r\n \r\n \n\r\nAnswers \r\nDevelopment Phase: (a) Define the problem - Youth \r\nunemployment means an existing youth without a paid job.  \r\n(b) Logical sequence steps to solve - 1. Government \r\nbuilding many manufacturing companies. 2. Organizing \r\nseminary for job creation.  3. Giving out loan. 4. Advertising \r\nfor job opportunities, Seminary and Loan giving out. \r\nImplementation Phase: Using Quick Basic \r\nCLS \r\nPRINT \"Building many manufacturing companies\"; \r\nPRINT \"Go join the seminary for job creation\"; \r\nINPUT \"How many youth attended the seminary :\", NUM; \r\nPRINT NUM; \r\nEND \r\n \r\n(4) There are four main forms of expressing an algorithm. \r\nList them \r\n(a) Pseudo code \r\n(b) Flowchart \r\n(c) Programming language \r\n(d) Control table \r\nReference page 3. \r\n \r\n \r\n \n\r\nExercise 2. \r\n(8) List five properties of a programming language \r\n (a) Reliability \r\n (b) Robustness \r\n (c) Usability \r\n (d) Portability \r\n (e) Maintainability \r\n (f) Efficiency/performance \r\n (g) Readability.   \r\nReference Page 10. \r\n \r\n(9) List three types of translators that there are. \r\n (a) Assemblers \r\n (b) Compilers \r\n (c) Interpreters \r\n \r\n(10) There are five generations of programming languages \r\nwhat are their characteristics \r\n(a) First generation: 1. They are directly executable by \r\nthe machine. 2. No translator is use to compile or \r\nassemble the first generation programming language. \r\n(b) Second generation: 1. Their code can be read and \r\nwritten by a programmer. \n\r\n\r\n\r\n2. The language is specific to a particular processor \r\nfamily and environment. \r\n(c) Third generation: 1. They are high level language. \r\n2. They are portable across many different \r\narchitectures. \r\n(d)  Fourth generation: They are mostly non \r\nprocedural meaning. They didn\'t need the programmer \r\nto specify every step for the program. \r\n Reference page 13 and 14. \r\n(11) List the five programming paradigm you know \r\n (a) Imperative paradigm. \r\n (b) Declarative programming paradigm \r\n (c) Functions programming paradigm \r\n (d) Object oriented programming \r\nReference Page 15 \r\n(12) There are three types of programming errors list them \r\n (a) Syntax error \r\n (b) Logical error \r\n (c) Runtime error \r\nReference Page 20. \r\n \r\n \r\n \r\n \n\r\n\r\n\r\nExercise 3. \r\n(1) What is the difference between debugging and \r\nsoftware testing? \r\nAnswer \r\nDebugging is a methodical process of finding and reducing \r\nbug in a computer program. This is for removing error. \r\nSoftware testing is the investigation carried out on a piece of \r\nsoftware or program to provide stakeholders with \r\ninformation about the software. This is for knowing the \r\neffectiveness the a software. \r\nReference Page 21. \r\n \r\n(2) List three types of software testing  \r\n(a) White-box testing \r\n(b) Black-box testing \r\n(c) Grey-box testing \r\nReference page 22. \r\n \r\n(3) List the debugging techniques you know \r\n(a) Print debugging \r\n(b) Remote debugging \r\n(c) Post mortem debugging \r\nReference page 21. \r\n \r\n \r\n \n\r\nExercise 4. \r\n(4) Discuss the following - objects, fields, classes and \r\nmethods \r\nAnswer \r\nReference Page 36. \r\n \r\nExercise 7. \r\n(1) Write a program in C++ which will calculate the simple \r\ninterest given that the principal is 6,000 naira the rate \r\nis 20 percent and the time is 5 years. The principal, \r\ntime and rate must be declared first. \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n// Topic : Simple Interest.cpp \r\n// Cousre : Programmeing language 1 \r\n#include \"stdafx.h\" \r\n#include <iostream> \r\nusing namespace std; \r\nint main() \r\n{ \r\n int principal = 6000, time = 5, rate = 20; \r\n cout << \"The principal : \" << principal << endl; \r\n cout << \"Enter the rate : \" << rate << endl; \r\n cout << \"Enter the time : \" << time << endl; \r\n cout << \"The Sinple interest : \" << (principal * rate * time)/100 << endl; \r\n return 0; \r\n} \r\n \n\r\n(8) Write a program in C++ that calculates the \r\ncircumference of a circle where the radius is 9cm and Pi is \r\ngiven as 3.142. \r\n (1) Using the radius method \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n(10) List 6 data types you know in C++ \r\nReference Page 69 and 70. \r\n \r\nExercise 8. \r\n(1) Write a program that outputs the result of 18 modulus \r\n7 \r\n \r\n \r\n \r\n \r\n \r\n \r\n/ circumference of a circle in C++.cpp \r\n// Using the method of Radius. \r\n#include \"stdafx.h\" \r\n#include <iostream> \r\nusing namespace std; \r\nint main() \r\n{ \r\n float const PI = 3.142; \r\n float radius = 20; \r\n cout << \"The radius : \" << radius << endl; \r\n cout << \"The Circumference of a Circle : \" << 2 * PI * radius << endl; \r\n return 0; \r\n} \r\n \r\n// No 5 The working of modules operators.cpp \r\n// \r\n#include \"stdafx.h\" \r\n#include <iostream> \r\nusing namespace std; \r\nint main() \r\n{ \r\n int divide, remainder; \r\n divide = 223 / 12; \r\n cout << \"Two number dividing 223 divid by 12 : \" << divide << endl; \r\n remainder = 223 % 12; \r\n cout << \"The remainder is : \" << remainder << endl; \r\n return 0; \r\n} \r\n \n(3) Write a program in C++ that adds 16 to 24 then \r\ndivides the result by 4 \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n(4) Write a program in C++ that compares the value of 5 \r\nand 55 and outputs the one that is greater. \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n// Adding and substraing C++.cpp  \r\n// Cousre : Programming language 1 \r\n#include \"stdafx.h\" \r\n#include <iostream> \r\nusing namespace std; \r\nint main() \r\n{ \r\n int Num1 = 16, Num2 = 24; \r\n float divide, add; \r\n add = Num1 + Num2; \r\n cout << \"Adding num1 and num2 : \" << add << endl; \r\n divide = add / 4; \r\n cout << \"Dividing by 4 : \" << divide << endl; \r\n return 0; \r\n} \r\n \r\n// No 6 using of IF statment and relational oper.cpp \r\n#include \"stdafx.h\" \r\n#include <iostream> \r\nusing namespace std; \r\nint main() \r\n{ \r\n int n1 = 5, n2 = 55; \r\n cout << \"Enter first number : \" << n1 << endl; \r\n cout << \"Enter second number : \" << n2 << endl; \r\n if (n1 == n2) \r\n  cout << \"Number are equal\" << endl; \r\n if (n1 > n2) \r\n  cout << \"First is greater second number\" << endl; \r\n if (n1 < n2) \r\n  cout << \"First number is less than second number\"; \r\n return 0; \r\n} \r\n \nExercise 12. \r\n(1) Declare a one dimensional array called friends which \r\ncontains a list of characters of five of your closet friends \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n(2) Write a C++ program and declare an array called pals \r\nwhich is a two dimensional array which contains a list of 7 of \r\nyour closet friends and their course of study. \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n// Supported By : Sep Club. \r\n#include \"stdafx.h\" \r\n#include <iostream> \r\n#include <string> \r\nusing namespace std; \r\nint main() \r\n{ \r\n string friends[5] = {\"Young dude \", \"Talented \", \"Ghandi \", \"Joyce \", \"Onyinye \"}; \r\n int i = 0; \r\n cout << \"The names of my closet friend is : \"; \r\n for (i = 0; i < 5; i++) \r\n { \r\n  cout << \"\\n\"; \r\n  cout << friends[i] << endl; \r\n } \r\n cout << \"\\n\"; \r\n return 0; \r\n} \r\n \r\n// Two dimension Array.cpp \r\n// Topic : Friends Names and course \r\n#include \"stdafx.h\" \r\n#include <iostream> \r\n#include <string> \r\nusing namespace std; \r\nint main() \r\n{ \r\n string pal[7][2] = {\"Talented \", \"Business Admin \", \"Young dude \", \"Computer \", \"Onyinye \", \r\n\"Nusring\" , \"Joyce   \", \"Accounting\" , \"Ghandi \", \"Engeering\" , \"Franklin \", \"Maths\"}; \r\n int a = 0, i = 0; \r\n cout << \"My friends name and course\" << endl; \r\n for (int i = 0; i < 7; i++) \r\n { \r\n  for (int a = 0; a < 2; a++) \r\n  { \r\n   cout << \"\\t \" << pal[i][a]; \r\n  } \r\n  cout << \"\\n\"; \r\n } \r\n return 0; \r\n} \r\n \n(2) Write a program in C++ declaring the class car and its \r\nobjects and methods. \r\n \r\n // Creating classes in C++.cpp \r\n#include \"stdafx.h\" \r\n#include <iostream> \r\n#include <string> \r\nusing namespace std; \r\nclass Car { \r\npublic : \r\n void MercedesCar(); \r\n void ToyotaCar(); \r\n}; \r\nvoid Car::MercedesCar() { \r\n cout << \"This is Mercedes method and object\" << endl; \r\n} \r\nvoid Car::ToyotaCar() { \r\n cout << \"This is Toyota method and object\" << endl; \r\n} \r\nint main() \r\n{       \r\n Car c;   \r\n c.MercedesCar(); \r\n c.ToyotaCar(); \r\n return 0; \r\n} \r\n \r\n ', 'pavilion g6', NULL, 'everyone', NULL, 0, NULL, 'assets/uploads/documents/Jawa_Assingment_(Rancho_Solution)1.pdf', NULL, '812.04', 'Jawa_Assingment_(Rancho_Solution).pdf', 'Jawa_Assingment_(Rancho_Solution).pdf', 0, 1510617722),
(5, NULL, 3, 1, 'The Basics of Cloud Computing', ' \r\n© 2011 Carnegie Mellon University. Produced for US-CERT, a government organization. 1 \r\n\r\nThe Basics of Cloud Computing \r\nAlexa Huth and James Cebula \r\n What is the cloud? \r\nCloud computing is receiving a great deal of attention, both in publications and among users, \r\nfrom individuals at home to the U.S. government. Yet it is not always clearly defined.1 Cloud \r\ncomputing is a subscription-based service where you can obtain networked storage space and computer resources. One way to think of cloud computing is to consider your experience with \r\nemail. Your email client, if it is Yahoo!, Gmail, Hotmail, and so on, takes care of housing all of \r\nthe hardware and software necessary to support your personal email account. When you want to \r\naccess your email you open your web browser, go to the email client, and log in. The most important part of the equation is having internet access. Your email is not housed on your \r\nphysical computer; you access it through an internet connection, and you can access it anywhere. \r\nIf you are on a trip, at work, or down the street getting coffee, you can check your email as long \r\nas you have access to the internet. Your email is different than software installed on your computer, such as a word processing program. When you create a document using word \r\nprocessing software, that document stays on the device you used to make it unless you physically \r\nmove it. An email client is similar to how cloud computing works. Except instead of accessing \r\njust your email, you can choose what information you have access to within the cloud. \r\nHow can you use the cloud? The cloud makes it possible for you to access your information from anywhere at any time. \r\nWhile a traditional computer setup requires you to be in the same location as your data storage \r\ndevice, the cloud takes away that step. The cloud removes the need for you to be in the same \r\nphysical location as the hardware that stores your data. Your cloud provider can both own and \r\nhouse the hardware and software necessary to run your home or business applications.  \r\nThis is especially helpful for businesses that cannot afford the same amount of hardware and \r\nstorage space as a bigger company. Small companies can store their information in the cloud, \r\nremoving the cost of purchasing and storing memory devices. Additionally, because you only \r\n                                                 \r\n1For more information please see The NIST Definition of Cloud Computing at \r\nhttp://csrc.nist.gov/publications/drafts/800-145/Draft-SP-800-145_cloud-definition.pdf.   \n \r\n 2 \r\nneed to buy the amount of storage space you will use, a business can purchase more space or \r\nreduce their subscription as their business grows or as they find they need less storage space. \r\nOne requirement is that you need to have an internet connection in order to access the cloud. \r\nThis means that if you want to look at a specific document you have housed in the cloud, you \r\nmust first establish an internet connection either through a wireless or wired internet or a mobile \r\nbroadband connection. The benefit is that you can access that same document from wherever you \r\nare with any device that can access the internet. These devices could be a desktop, laptop, tablet, \r\nor phone. This can also help your business to function more smoothly because anyone who can \r\nconnect to the internet and your cloud can work on documents, access software, and store data. \r\nImagine picking up your smartphone and downloading a .pdf document to review instead of \r\nhaving to stop by the office to print it or upload it to your laptop. This is the freedom that the \r\ncloud can provide for you or your organization.  \r\nTypes of clouds \r\nThere are different types of clouds that you can subscribe to depending on your needs. As a \r\nhome user or small business owner, you will most likely use public cloud services.  \r\n1. Public Cloud - A public cloud can be accessed by any subscriber with an internet connection \r\nand access to the cloud space.  \r\n2. Private Cloud - A private cloud is established for a specific group or organization and limits \r\naccess to just that group. \r\n3. Community Cloud - A community cloud is shared among two or more organizations that \r\nhave similar cloud requirements.  \r\n4. Hybrid Cloud - A hybrid cloud is essentially a combination of at least two clouds, where the \r\nclouds included are a mixture of public, private, or community.  \r\nChoosing a cloud provider \r\nEach provider serves a specific function, giving users more or less control over their cloud \r\ndepending on the type. When you choose a provider, compare your needs to the cloud services \r\navailable. Your cloud needs will vary depending on how you intend to use the space and \r\nresources associated with the cloud. If it will be for personal home use, you will need a different \r\ncloud type and provider than if you will be using the cloud for business. Keep in mind that your \r\ncloud provider will be pay-as-you-go, meaning that if your technological needs change at any \r\npoint you can purchase more storage space (or less for that matter) from your cloud provider.  \r\nThere are three types of cloud providers that you can subscribe to: Software as a Service (SaaS), \r\nPlatform as a Service (PaaS), and Infrastructure as a Service (IaaS). These three types differ in \r\nthe amount of control that you have over your information, and conversely, how much you can \r\nexpect your provider to do for you. Briefly, here is what you can expect from each type. \r\n1. Software as a Service - A SaaS provider gives subscribers access to both resources and \r\napplications. SaaS makes it unnecessary for you to have a physical copy of software to install \r\non your devices. SaaS also makes it easier to have the same software on all of your devices at \n \r\n 3 \r\nonce by accessing it on the cloud. In a SaaS agreement, you have the least control over the \r\ncloud. \r\n2. Platform as a Service - A PaaS system goes a level above the Software as a Service setup. A \r\nPaaS provider gives subscribers access to the components that they require to develop and \r\noperate applications over the internet.  \r\n3. Infrastructure as a Service - An IaaS agreement, as the name states, deals primarily with \r\ncomputational infrastructure. In an IaaS agreement, the subscriber completely outsources the \r\nstorage and resources, such as hardware and software, that they need.  \r\n \r\nAs you go down the list from number one to number three, the subscriber gains more control \r\nover what they can do within the space of the cloud. The cloud provider has less control in an \r\nIaaS system than with an SaaS agreement. \r\n \r\nWhat does this mean for the home user or business looking to start using the cloud? It means you \r\ncan choose your level of control over your information and types of services that you want from \r\na cloud provider. For example, imagine you are starting up your own small business. You cannot \r\nafford to purchase and store all of the hardware and software necessary to stay on the cutting \r\nedge of your market. By subscribing to an Infrastructure as a Service cloud, you would be able to \r\nmaintain your new business with just as much computational capability as a larger, more \r\nestablished company, while only paying for the storage space and bandwidth that you use. \r\nHowever, this system may mean you have to spend more of your resources on the development \r\nand operation of applications. As you can see, you should evaluate your current computational \r\nresources, the level of control you want to have, your financial situation, and where you foresee \r\nyour business going before signing up with a cloud provider.  \r\n \r\nIf you are a home user, however, you will most likely be looking at free or low-cost cloud \r\nservices (such as web-based email) and will not be as concerned with many of the more complex \r\ncloud offerings.  \r\n \r\nAfter you have fully taken stock of where you are and where you want to be, research into each \r\ncloud provider will give you a better idea of whether or not they are right for you. \r\nSecurity \r\nThe information housed on the cloud is often seen as valuable to individuals with malicious \r\nintent. There is a lot of personal information and potentially secure data that people store on their \r\ncomputers, and this information is now being transferred to the cloud. This makes it critical for \r\nyou to understand the security measures that your cloud provider has in place, and it is equally \r\nimportant to take personal precautions to secure your data.  \r\nThe first thing you must look into is the security measures that your cloud provider already has \r\nin place. These vary from provider to provider and among the various types of clouds. What \r\nencryption methods do the providers have in place? What methods of protection do they have in \r\nplace for the actual hardware that your data will be stored on? Will they have backups of my \r\ndata? Do they have firewalls set up? If you have a community cloud, what barriers are in place to \r\nkeep your information separate from other companies? Many cloud providers have standard \r\nterms and conditions that may answer these questions, but the home user will probably have little \n \r\n 4 \r\nnegotiation room in their cloud contract. A small business user may have slightly more room to \r\ndiscuss the terms of their contract with the provider and will be able to ask these questions \r\nduring that time. There are many questions that you can ask, but it is important to choose a cloud \r\nprovider that considers the security of your data as a major concern. \r\nNo matter how careful you are with your personal data, by subscribing to the cloud you will be \r\ngiving up some control to an external source. This distance between you and the physical \r\nlocation of your data creates a barrier. It may also create more space for a third party to access \r\nyour information. However, to take advantage of the benefits of the cloud, you will have to \r\nknowingly give up direct control of your data. On the converse, keep in mind that most cloud \r\nproviders will have a great deal of knowledge on how to keep your data safe. A provider likely \r\nhas more resources and expertise than the average user to secure their computers and networks. \r\nConclusions \r\nTo summarize, the cloud provides many options for the everyday computer user as well as large \r\nand small businesses. It opens up the world of computing to a broader range of uses and \r\nincreases the ease of use by giving access through any internet connection. However, with this \r\nincreased ease also come drawbacks. You have less control over who has access to your \r\ninformation and little to no knowledge of where it is stored. You also must be aware of the \r\nsecurity risks of having data stored on the cloud. The cloud is a big target for malicious \r\nindividuals and may have disadvantages because it can be accessed through an unsecured \r\ninternet connection.  \r\nIf you are considering using the cloud, be certain that you identify what information you will be \r\nputting out in the cloud, who will have access to that information, and what you will need to \r\nmake sure it is protected. Additionally, know your options in terms of what type of cloud will be \r\nbest for your needs, what type of provider will be most useful to you, and what the reputation \r\nand responsibilities of the providers you are considering are before you sign up.  \r\nFurther Reading \r\n1. Lewis, Grace. Cloud Computing: Finding the Silver Lining, Not the Silver Bullet. \r\nhttp://www.sei.cmu.edu/newsitems/cloudcomputing.cfm (2009). \r\n2. Dormann, Will & Rafail, Jason. Securing Your Web Browser. \r\nhttp://www.cert.org/tech_tips/securing_browser/ (2006). \r\n3. Jansen, Wayne & Grance, Timothy. Guidelines on Security and Privacy in Public Cloud \r\nComputing. National Institute of Standards and Technology, 2011. \r\n4. Strowd, Harrison & Lewis, Grace. T-Check in System-of-Systems Technologies: Cloud \r\nComputing (CMU/SEI-2010-TN-009). Software Engineering Institute, Carnegie Mellon \r\nUniversity, 2010. http://www.sei.cmu.edu/library/abstracts/reports/10tn009.cfm \r\n5. Lewis, Grace. Basics About Cloud Computing. \r\nhttp://www.sei.cmu.edu/library/abstracts/whitepapers/cloudcomputingbasics.cfm (2010). ', 'Alexa Huth and James Cebula', NULL, 'everyone', NULL, 0, NULL, 'assets/uploads/documents/the_basics_of_cloud_computing.pdf', NULL, '40.55', 'the_basics_of_cloud_computing.pdf', 'the_basics_of_cloud_computing.pdf', 0, 1510617849);

-- --------------------------------------------------------

--
-- Table structure for table `document_category`
--

DROP TABLE IF EXISTS `document_category`;
CREATE TABLE `document_category` (
  `doc_cat_id` int(11) NOT NULL,
  `doc_category` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `last_added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document_category`
--

INSERT INTO `document_category` (`doc_cat_id`, `doc_category`, `is_deleted`, `last_added`) VALUES
(2, 'Category 1', 0, 1510440438),
(3, 'unknown documents', 0, 1510442578),
(4, 'project', 0, 1510509051),
(5, 'Past questions', 0, 1510519265);

-- --------------------------------------------------------

--
-- Table structure for table `document_type`
--

DROP TABLE IF EXISTS `document_type`;
CREATE TABLE `document_type` (
  `doctype_id` int(11) NOT NULL,
  `doc_type` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `last_added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document_type`
--

INSERT INTO `document_type` (`doctype_id`, `doc_type`, `is_deleted`, `last_added`) VALUES
(1, '.pdf', 0, 1510423877);

-- --------------------------------------------------------

--
-- Table structure for table `fav_documents`
--

DROP TABLE IF EXISTS `fav_documents`;
CREATE TABLE `fav_documents` (
  `fav_doc_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `added_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fav_documents`
--

INSERT INTO `fav_documents` (`fav_doc_id`, `user_id`, `doc_id`, `added_date`) VALUES
(3, 9, 2, '15-11-2017'),
(4, 11, 5, '15-11-2017'),
(5, 8, 2, '15-11-2017');

-- --------------------------------------------------------

--
-- Table structure for table `share_document`
--

DROP TABLE IF EXISTS `share_document`;
CREATE TABLE `share_document` (
  `share_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ucontact_id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `shared_date` text NOT NULL,
  `u1_del` tinyint(1) NOT NULL DEFAULT '0',
  `u2_del` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `share_document`
--

INSERT INTO `share_document` (`share_id`, `user_id`, `ucontact_id`, `doc_id`, `shared_date`, `u1_del`, `u2_del`) VALUES
(14, 8, 10, 2, '14-11-17', 0, 0),
(15, 8, 9, 2, '14-11-17', 0, 0),
(16, 8, 8, 2, '14-11-17', 0, 0),
(17, 8, 11, 2, '14-11-17', 0, 0),
(18, 11, 10, 5, '15-11-17', 0, 0),
(19, 11, 9, 5, '15-11-17', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pword` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `options` text NOT NULL,
  `regdate` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `pword`, `email`, `phone`, `is_admin`, `options`, `regdate`, `firstname`, `lastname`) VALUES
(7, 'administrator', 'b2b4d841d70f61baec1adfc1692939c0', 'admin@admin.com', '09012345678', 1, '', 0, 'Hillary', 'Sylvester'),
(8, 'sylvacoin', 'ea5077677af8871716a36dfe83e662d8', 'slykid4u@gmail.com', '09012345678', 0, '', 0, 'Hill', 'Mendez'),
(9, 'yd', 'ea5077677af8871716a36dfe83e662d8', 'yd@gmail.com', '09012345677', 0, '', 0, 'Cyril', 'Ikelie'),
(10, 'rancho', 'ea5077677af8871716a36dfe83e662d8', 'rancho@gmail.com', '09012345676', 0, '', 0, 'Ekene', 'Olum'),
(11, 'blaq', 'ea5077677af8871716a36dfe83e662d8', 'blaq@gmail.com', '09012345675', 0, '', 0, 'Stanley', 'Iwejuo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `document_category`
--
ALTER TABLE `document_category`
  ADD PRIMARY KEY (`doc_cat_id`);

--
-- Indexes for table `document_type`
--
ALTER TABLE `document_type`
  ADD PRIMARY KEY (`doctype_id`);

--
-- Indexes for table `fav_documents`
--
ALTER TABLE `fav_documents`
  ADD PRIMARY KEY (`fav_doc_id`);

--
-- Indexes for table `share_document`
--
ALTER TABLE `share_document`
  ADD PRIMARY KEY (`share_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `document_category`
--
ALTER TABLE `document_category`
  MODIFY `doc_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `document_type`
--
ALTER TABLE `document_type`
  MODIFY `doctype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `fav_documents`
--
ALTER TABLE `fav_documents`
  MODIFY `fav_doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `share_document`
--
ALTER TABLE `share_document`
  MODIFY `share_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
