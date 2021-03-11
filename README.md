# Hiragana Learning Single-Page Application
## **PROJECT STRUCTURE**
### **Files for communicating with MariaDB:**

- [ ] db_config.php    (set up a connection to a database)

- [ ] login.php        (user login)

- [ ] register.php     (user registration)

- [ ] addScore.php     (to save score after completing a quiz)

- [ ] loadresults.php  (to display user progress on screen)


### **SQL**

- [ ] hiragana.sql     (SQL file to create a table in a database)

### **Front-end and multimedia files:**

- [ ] GitHub           (folder with all multimedia files used in the app(pictures, sounds, animations, etc)

- [ ] idex.php         (front-end)

- [ ] style1.css       (front-end styling)

## **APPLICATION DESCRIPTION**
This single-page application (SPA) was created using **Javascript**, **PHP**, **CSS** and **HTML**. It is using **jQuery** to make **Ajax calls**, which enables it to make asynchronous HTTP requests *without the need for a full page refresh*.
The application is connected to **MariaDB** where its data is stored and is later retrieved from.
The application lets you practice writing, pronouncing and recognizing hiragana characters and their corresponding romaji equivalents.
![https://github.com/cmulation/Hiragana-Learning-SPA/blob/master/Capture1.JPG](Capture1.JPG)
Hover the mouse above a character to see a gif demonstrating how to write it. Click on a character to hear how to pronounce it.

<img src= "https://github.com/cmulation/Hiragana-Learning-SPA/blob/master/writing-demonstration.jpg" width="300" height="300"/> ![](https://github.com/cmulation/Hiragana-Learning-SPA/blob/master/GitHub/NE.gif)

Register to save your score. User details provided during registration are sent to the DB via **HTTP POST request** in an Ajax call. 
After registering, the user can login and see their progress displayed on screen.
Checking learning progress can be done by completing any of the 5 quizes provided by the app. 
The score is displayed on the screen after quiz completion.

<img src= "https://github.com/cmulation/Hiragana-Learning-SPA/blob/master/quiz.jpg" width="800" height="400"/>

All resources used to help create this applicationg are referenced at the bottom of the page.

<img src= "https://github.com/cmulation/Hiragana-Learning-SPA/blob/master/resources.jpg" width="313" height="184"/>
<br>
