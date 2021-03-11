<!DOCTYPE html>
<html>
<head>
        <!--include jquery-->
		<title>Learn Hiragana!</title>
		<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <!--include css-->		
		<link rel="stylesheet" type="text/css" href = "style1.css"> 

		<script>
        var lgduser = ""; //to keep track of the logged in user
        var fscore = 0; //to store quiz scores
        var chosenq = 0; //to store number of quiz

        //to login the user
		$(document).ready(function() 
        {
			$("#login").click(function() 
            {
				var name = $("#name_log").val();
				var pswrd = $("#pass_log").val();
				var count = 0;
				$.post("login.php", {details: name, verify: pswrd}, function(data)
                {
                    lgduser = data.substring(data.lastIndexOf(",") + 2, data.lastIndexOf("!"));
                    $("#showUser").html(data);
				});

                //to display previously saved scores
                $.post("loadresults.php", {details: name, verify: pswrd}, function(data)
                {
                    $("#showResults").show();
                    $("#showResults").html(data);
                });
				$("#logscreen :input").each( function() 
                {
					$(this).val('');
					count++;
					if (count>1)
						return false;
				});
			});

            //to register a new user
			$("#reg").click(function() 
            {
				var name = $("#name_reg").val();
				var email = $("#email_reg").val();
				var pswrd = $("#pass_reg").val();
				var count = 0;				
				$.post("register.php", {details: name, contact: email, verify: pswrd}, function(data)
                {
                    $("#showUser").html(data);
				});		
				$("#regscreen :input").each( function() 
                {
					$(this).val('');
					count++;
					if (count>2)
						return false;		
				});
                    	
			});
            
            //to save current result
            $("#saveres").click(function() 
            {
                if(lgduser=="")
                { 
                    alert("Please log in to save your score.")
                }
                else
                {                         
                    $.post("addScore.php", {details: lgduser, type: chosenq, result: fscore}, function(data)
                    {
                        $("#showUser").html(data);
                    });
                }   
            });

            //to go back to practicing hiragana/romaji
            $("#back").click(function() 
            {
                  $("#quizform").hide(); //hide quiz
                  $("#saveres").hide(); //hide save button
                  $("#back").hide(); //hide goBackToPractice button
                  $("#showScore").hide(); //hide score
                  $("#hiragana").show(); //show the table                  
            });
		});
		
		</script>

	<!--Registration Form-->
	<form id="regscreen">
		
            <div class="form__group">
    			<input class = "form_group" id="name_reg"  type="text" name="username"  value="" placeholder="Username"/>
            </div>
            <div class="form__group">
    			<input class = "form_group" id="email_reg" type="text" name="email" value="" placeholder="Email"/>
            </div>
            <div class="form__group">
    			<input class = "form_group" id="pass_reg" type="password" name="password" value="" placeholder="Password"/>
            </div>            
            </br>
    			<input  class = "btn" id="reg" type="button" value="Register" />
    			<p id="r_response"></p>
            </br>
            </form>		
	
    <!--Login Form-->
	<form id="logscreen">
		<div class="form__group">
			<input class = "form_group" id="name_log" type="text" name="username" placeholder="Username"/>
        </div> 
        <div class="form__group">
			<input class = "form_group" id="pass_log" type="password" name="password" placeholder = "Password"/>
        </div>
        </br>
		<input  id="login"type="button" class = "btn" value="Login" />
		<p id="l_response"></p>
    </form>

    <div id="showResults" style="display:hidden"></div>
			
<!--select a training set-->
<button id="showQuiz1" title = "Training set 1: Hiragana to romaji" class="btnq" onclick = "buildQuiz(1)">Select Quiz 1</button>
<button id="showQuiz2" title = "Training set 2: Romaji to hiragana"class="btnq" onclick = "buildQuiz(2)">Select Quiz 2</button>
<button id="showQuiz3" title = "Training set 3: Hiragana to romaji" class="btnq" onclick = "buildQuiz(3)">Select Quiz 3</button>
<button id="showQuiz4" title = "Training set 4: Romaji to hiragana" class="btnq" onclick = "buildQuiz(4)">Select Quiz 4</button>
<button id="showQuiz5" title = "Training set 5: MIXED QUESTIONS" class="btnq"onclick = "buildQuiz(5)">Select Quiz 5</button>
</br>
<div id="showUser"></div>
</br>

<!----------------------------------------------------------Quiz blueprint--------------------------------------------------------->
<div class = "grid" id = "quizform">
    <div id = "quiz">
        <h1 id = "quizHeader">Quiz</h1>
        <hr id = "quizUnderline">
        <p id = "question"></p>

        <!--Quiz options-->
        <div class="buttons">
            <button id = "btn0"><span id = "choice0"></span></button>
            <button id = "btn1"><span id = "choice1"></span></button>
            <button id = "btn2"><span id = "choice2"></span></button>
            <button id = "btn3"><span id = "choice3"></span></button>
        </div>
        <hr>
        <footer>
            <p id = "progress">Question x out of y</p>
        </footer>
    </div>
</div>
</br>

<!--for displaying score-->
<div id="showScore"></div>
<!--save button-->
<input  id="saveres" type="button" value="Save Score"/>
<button  id="back" class="btnq">Back to Practice</button>

<script type="text/javascript">
    document.getElementById("saveres").style.display = "none"; //hide save button
    document.getElementById("back").style.display = "none"; //hide backToPractice button
    document.getElementById("quizform").style.display = "none"; //hide quiz until the button is clicked
    

//quiz processing
function buildQuiz(x)
{
    chosenq = x; //save the number of the quiz taken
    $("#showScore").hide(); //hide score
    document.getElementById("hiragana").style.display = "none"; //hide hiragana table
    document.getElementById("quizform").style.display = "block"; //show quiz

    if (x==1)//if the user chosen quiz 1
    {
        document.getElementById("quizHeader").innerHTML="Quiz1"; //change the heading
            //create questions and answers to load into the quiz
            var questions = 
            [
            new Question("What is the corresponding romaji for this hiragana character?  あ",["KA","MO","WO","A"],"A"),
            new Question("What is the corresponding romaji for this hiragana character?  い",["TO","I","TSU","TA"],"I"),
            new Question("What is the corresponding romaji for this hiragana character?  う",["TA","SE","SA","U"],"U"),
            new Question("What is the corresponding romaji for this hiragana character?  え",["SHI","TSU","HA","E"],"E"),
            new Question("What is the corresponding romaji for this hiragana character?  お",["RI","O","RA","NE"],"O"),
            new Question("What is the corresponding romaji for this hiragana character?  か",["NA","I","KA","N"],"KA"),
            new Question("What is the corresponding romaji for this hiragana character?  き",["KI","ME","Mo","A"],"KI"),
            new Question("What is the corresponding romaji for this hiragana character?  く",["SHI","KU","HI","A"],"KU"),
            new Question("What is the corresponding romaji for this hiragana character?  け",["YU","YO","KE","A"],"KE"),
            new Question("What is the corresponding romaji for this hiragana character?  こ",["KO","RE","FU","MA"],"KO")
            ];
    }

    else if(x==2) //if the user chosen quiz 2
    {
            document.getElementById("quizHeader").innerHTML="Quiz2"; //change the heading
            //create questions and answers to load into the quiz
            var questions = 
            [
            new Question("What is the corresponding hiragana character for this romaji?  SA",["あ","ち","さ","け"],"さ"),
            new Question("What is the corresponding hiragana character for this romaji?  SHI",["い","し","つ","て"],"し"),
            new Question("What is the corresponding hiragana character for this romaji?  SU",["う","す","え","ほ"],"す"),
            new Question("What is the corresponding hiragana character for this romaji?  SE",["え","よ","く","せ"],"せ"),
            new Question("What is the corresponding hiragana character for this romaji?  SO",["お","そ","む","ぬ"],"そ"),
            new Question("What is the corresponding hiragana character for this romaji?  TA",["か","ほ","た","よ"],"た"),
            new Question("What is the corresponding hiragana character for this romaji?  CHI",["き","ら","わ","ち"],"ち"),
            new Question("What is the corresponding hiragana character for this romaji?  TSU",["つ","く","ふ","ら"],"つ"),
            new Question("What is the corresponding hiragana character for this romaji?  TE",["け","わ","て","ふ"],"て"),
            new Question("What is the corresponding hiragana character for this romaji?  TO",["こ","ぬ","む","と"],"と")
            ];
    }
    else if(x==3) //if the user chosen quiz 3
    {
        document.getElementById("quizHeader").innerHTML="Quiz3"; //change the heading
            //create questions and answers to load into the quiz
            var questions = 
            [
            new Question("What is the corresponding romaji for this hiragana character?  な",["KA","YO","WO","NA"],"NA"),
            new Question("What is the corresponding romaji for this hiragana character?  に",["TO","I","TSU","NI"],"NI"),
            new Question("What is the corresponding romaji for this hiragana character?  ぬ",["TA","SE","SA","NU"],"NU"),
            new Question("What is the corresponding romaji for this hiragana character?  ね",["SHI","TSU","HA","NE"],"NE"),
            new Question("What is the corresponding romaji for this hiragana character?  の",["RI","NO","RA","NO"],"NO"),
            new Question("What is the corresponding romaji for this hiragana character?  は",["HA","I","KA","N"],"HA"),
            new Question("What is the corresponding romaji for this hiragana character?  ひ",["HI","ME","Mo","A"],"HI"),
            new Question("What is the corresponding romaji for this hiragana character?  ふ",["SHI","FU","HI","A"],"FU"),
            new Question("What is the corresponding romaji for this hiragana character?  へ",["YU","YO","HE","A"],"HE"),
            new Question("What is the corresponding romaji for this hiragana character?  ほ",["HO","RE","FU","MA"],"HO")
            ];
    }
    else if(x==4) //if the user chosen quiz 4
    {
        document.getElementById("quizHeader").innerHTML="Quiz4"; //change the heading
            //create questions and answers to load into the quiz
            var questions = 
            [
            new Question("What is the corresponding hiragana character for this romaji?  MA",["あ","ま","さ","け"],"ま"),
            new Question("What is the corresponding hiragana character for this romaji?  MI",["い","し","つ","み"],"み"),
            new Question("What is the corresponding hiragana character for this romaji?  MU",["む","す","え","ほ"],"む"),
            new Question("What is the corresponding hiragana character for this romaji?  ME",["え","め","く","せ"],"め"),
            new Question("What is the corresponding hiragana character for this romaji?  MO",["お","そ","も","ぬ"],"も"),
            new Question("What is the corresponding hiragana character for this romaji?  YA",["か","ほ","た","や"],"や"),
            new Question("What is the corresponding hiragana character for this romaji?  YU",["き","ゆ","わ","ち"],"ゆ"),
            new Question("What is the corresponding hiragana character for this romaji?  YO",["つ","く","よ","ら"],"よ"),
            new Question("What is the corresponding hiragana character for this romaji?  RA",["け","ら","て","ふ"],"ら"),
            new Question("What is the corresponding hiragana character for this romaji?  RI",["り","ぬ","む","と"],"り")
            ];        
    }
    else if(x==5) //if the user chosen quiz 5
    {
        document.getElementById("quizHeader").innerHTML="Quiz5"; //change the heading
            //create questions and answers to load into the quiz
            var questions = 
            [
            new Question("What is the corresponding romaji for this hiragana character?  る",["KA","RU","WO","NA"],"RU"),
            new Question("What is the corresponding romaji for this hiragana character?  RE",["に","れ","ぬ","は"],"れ"),
            new Question("What is the corresponding romaji for this hiragana character?  ろ",["TA","SE","RO","NU"],"RO"),
            new Question("What is the corresponding romaji for this hiragana character?  わ",["SHI","WA","HA","NE"],"WA"),
            new Question("What is the corresponding romaji for this hiragana character?  WO",["の","に","を","は"],"を"),
            new Question("What is the corresponding romaji for this hiragana character?  ん",["WA","I","KA","N"],"N"),
            new Question("What is the corresponding romaji for this hiragana character?  A",["の","に","あ","れ"],"あ"),
            new Question("What is the corresponding romaji for this hiragana character?  う",["SHI","U","HI","A"],"U"),
            new Question("What is the corresponding romaji for this hiragana character?  こ",["YU","A","HE","A"],"KO"),
            new Question("What is the corresponding romaji for this hiragana character?  す",["に","RE","の","を"],"SU")
            ];
    }
    else
    {
        //do nothing
    }

    //Quiz object constructor
    function Quiz(questions)
    {
        this.score = 0;
        this.questions = questions;
        this.questionIndex = 0;
    }

    //to keep track of the current question
    Quiz.prototype.getQuestionIndex = function()
    {
        return this.questions[this.questionIndex];
    }
    //to keep track of the last question
    Quiz.prototype.isEnded = function()
    {
        return this.questions.length === this.questionIndex;
    }
    //to update score and move to the next question
    Quiz.prototype.guess = function(answer)
    {
        if(this.getQuestionIndex().correctAnswer(answer))
        {
            this.score++;//update score
        }
            this.questionIndex++; //go to the next question
    }

    //Quiz question object constructor
    function Question(text, choices, answer)
    {
        this.text = text;
        this.choices = choices;
        this.answer = answer;
    }
    //to check if the selected option is correct
    Question.prototype.correctAnswer = function(choice)
    {
        return choice === this.answer;
    }

    //insert the selected Q&A training set into the quiz
    function populate()
    {
        if(quiz.isEnded())
        {
            showScores(); //display score only at the end of the quiz
        }
        else
        {     
            var element = document.getElementById("question");//show question
            element.innerHTML = quiz.getQuestionIndex().text;            
            var choices = quiz.getQuestionIndex().choices;//show choices
            for(var i = 0; i<choices.length;i++)//for movinf through the questions
            {
                var element = document.getElementById("choice" + i);
                element.innerHTML = choices[i];
                guess("btn" + i, choices[i]);
            }
                showProgress(); //display how many questions left
            }
        }

    //for selecting the answer
    function guess(id, guess)
    {
        var button = document.getElementById(id);
        button.onclick = function()
        {
            quiz.guess(guess);
            populate();
        }
    }

    //display how many questions left
    function showProgress()
    {
        var currentQuestionNumber = quiz.questionIndex + 1;
        var element = document.getElementById("progress");
        element.innerHTML = "Question " + currentQuestionNumber + "/" + quiz.questions.length;
    }

    //display score at the end of the quiz
    function showScores()
    {
        document.getElementById("saveres").style.display = "inline-block";
        document.getElementById("back").style.display = "inline-block";
        fscore = Math.round((quiz.score/10)*100);
        $("#showScore").show();
        document.getElementById("showScore").innerHTML = "Your score is: " + fscore+"%";
    }
    var quiz = new Quiz(questions); //create a new Quiz object and insert the corresponding Q&A training set into it
    populate();
}
</script>

<!------------------------------------------------Images and Sounds----------------------------------------------------------------------->

<!--Sounds-->
<audio id="ax" src="a.mp3" ></audio>
<audio id="ix" src="i.mp3" ></audio>
<audio id="ux" src="u.mp3" ></audio>
<audio id="ex" src="e.mp3" ></audio>
<audio id="ox" src="o.mp3" ></audio>
<audio id="kax" src="ka.mp3" ></audio>
<audio id="kix" src="ki.mp3" ></audio>
<audio id="kux" src="ku.mp3" ></audio>
<audio id="kex" src="ke.mp3" ></audio>
<audio id="kox" src="ko.mp3" ></audio>

<audio id="sax" src="sa.mp3" ></audio>
<audio id="shix" src="shi.mp3" ></audio>
<audio id="sux" src="su.mp3" ></audio>
<audio id="sex" src="se.mp3" ></audio>
<audio id="sox" src="so.mp3" ></audio>
<audio id="tax" src="ta.mp3" ></audio>
<audio id="chix" src="chi.mp3" ></audio>
<audio id="tsux" src="tsu.mp3" ></audio>
<audio id="tex" src="te.mp3" ></audio>
<audio id="tox" src="to.mp3" ></audio>

<audio id="nax" src="na.mp3" ></audio>
<audio id="nix" src="ni.mp3" ></audio>
<audio id="nux" src="nu.mp3" ></audio>
<audio id="nex" src="ne.mp3" ></audio>
<audio id="nox" src="no.mp3" ></audio>
<audio id="hax" src="ha.mp3" ></audio>
<audio id="hix" src="ta.mp3" ></audio>
<audio id="fux" src="fu.mp3" ></audio>
<audio id="hex" src="he.mp3" ></audio>
<audio id="hox" src="ho.mp3" ></audio>

<audio id="max" src="ma.mp3" ></audio>
<audio id="mix" src="mi.mp3" ></audio>
<audio id="mux" src="mu.mp3" ></audio>
<audio id="mex" src="me.mp3" ></audio>
<audio id="mox" src="mo.mp3" ></audio>
<audio id="yax" src="ya.mp3" ></audio>
<audio id="yux" src="yu.mp3" ></audio>
<audio id="rox" src="yo.mp3" ></audio>
<audio id="rax" src="ra.mp3" ></audio>
<audio id="rix" src="ri.mp3" ></audio>

<audio id="rux" src="ru.mp3" ></audio>
<audio id="rex" src="re.mp3" ></audio>
<audio id="rox" src="ro.mp3" ></audio>
<audio id="wax" src="wa.mp3" ></audio>
<audio id="wox" src="wo.mp3" ></audio>
<audio id="nx" src="n.mp3" ></audio>

<!--for playing sounds-->
    <script>
        function playSound(element)
        {
            var id = element.parentElement.id;
            id = id + 'x';
            var audio = document.getElementById(id);
            audio.play();
        }
   </script>

<!--Pictures of hiragana/romaji and animations-->
<div id = "mytable">
<table class="tg" id="hiragana">
  <tr>
    <td class="tg-0lax" id="a"><img src="a1.jpg" onmouseover="this.src='A.gif'"onmouseout="this.src='a1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="i"><img src="i1.jpg" onmouseover="this.src='I.gif'"onmouseout="this.src='i1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="u"><img src="u1.jpg" onmouseover="this.src='U.gif'"onmouseout="this.src='u1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="e"><img src="e1.jpg" onmouseover="this.src='E.gif'"onmouseout="this.src='e1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="o"><img src="o1.jpg" onmouseover="this.src='O.gif'"onmouseout="this.src='o1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="ka"><img src="ka1.jpg" onmouseover="this.src='KA.gif'"onmouseout="this.src='ka1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="ki"><img src="ki1.jpg" onmouseover="this.src='KI.gif'"onmouseout="this.src='ki1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="ku"><img src="ku1.jpg" onmouseover="this.src='KU.gif'"onmouseout="this.src='ku1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="ke"><img src="ke1.jpg" onmouseover="this.src='KE.gif'"onmouseout="this.src='ke1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="ko"><img src="ko1.jpg" onmouseover="this.src='KO.gif'"onmouseout="this.src='ko1.jpg'" onclick="playSound(this);"/></td>
  </tr>

    <tr>
    <td class="tg-0lax" id="sa"><img src="sa1.jpg" onmouseover="this.src='SA.gif'"onmouseout="this.src='sa1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="shi"><img src="shi1.jpg" onmouseover="this.src='SHI.gif'"onmouseout="this.src='shi1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="su"><img src="su1.jpg" onmouseover="this.src='SU.gif'"onmouseout="this.src='su1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="se"><img src="se1.jpg" onmouseover="this.src='SE.gif'"onmouseout="this.src='se1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="so"><img src="so1.jpg" onmouseover="this.src='SO.gif'"onmouseout="this.src='so1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="ta"><img src="ta1.jpg" onmouseover="this.src='TA.gif'"onmouseout="this.src='ta1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="chi"><img src="chi1.jpg" onmouseover="this.src='CHI.gif'"onmouseout="this.src='chi1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="tsu"><img src="tsu1.jpg" onmouseover="this.src='TSU.gif'"onmouseout="this.src='tsu1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="te"><img src="te1.jpg" onmouseover="this.src='TE.gif'"onmouseout="this.src='te1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="to"><img src="to1.jpg" onmouseover="this.src='TO.gif'"onmouseout="this.src='to1.jpg'" onclick="playSound(this);"/></td>
  </tr>

  <tr>
    <td class="tg-0lax" id="na"><img src="na1.jpg"  onmouseover="this.src='NA.gif'"onmouseout="this.src='na1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="ni"><img src="ni1.jpg"  onmouseover="this.src='NI.gif'"onmouseout="this.src='ni1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="nu"><img src="nu1.jpg"  onmouseover="this.src='NU.gif'"onmouseout="this.src='nu1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="ne"><img src="ne1.jpg"  onmouseover="this.src='NE.gif'"onmouseout="this.src='ne1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="no"><img src="no1.jpg"  onmouseover="this.src='NO.gif'"onmouseout="this.src='no1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="ha"><img src="ha1.jpg"  onmouseover="this.src='HA.gif'"onmouseout="this.src='ha1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="hi"><img src="hi1.jpg"  onmouseover="this.src='HI.gif'"onmouseout="this.src='hi1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="fu"><img src="fu1.jpg"  onmouseover="this.src='FU.gif'"onmouseout="this.src='fu1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="he"><img src="he1.jpg"  onmouseover="this.src='HE.gif'"onmouseout="this.src='he1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="ho"><img src="ho1.jpg"  onmouseover="this.src='HO.gif'"onmouseout="this.src='ho1.jpg'" onclick="playSound(this);"/></td>
  </tr>
  <tr>
    <td class="tg-0lax" id="ma"><img src="ma1.jpg"  onmouseover="this.src='MA.gif'"onmouseout="this.src='ma1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="mi"><img src="mi1.jpg"  onmouseover="this.src='MI.gif'"onmouseout="this.src='mi1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="mu"><img src="mu1.jpg"  onmouseover="this.src='MU.gif'"onmouseout="this.src='mu1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="me"><img src="me1.jpg"  onmouseover="this.src='ME.gif'"onmouseout="this.src='me1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="mo"><img src="mo1.jpg"  onmouseover="this.src='MO.gif'"onmouseout="this.src='mo1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="ya"><img src="ya1.jpg"  onmouseover="this.src='YA.gif'"onmouseout="this.src='ya1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="yu"><img src="yu1.jpg"  onmouseover="this.src='YU.gif'"onmouseout="this.src='yu1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="ro"><img src="yo1.jpg"  onmouseover="this.src='YO.gif'"onmouseout="this.src='yo1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="ra"><img src="ra1.jpg"  onmouseover="this.src='RA.gif'"onmouseout="this.src='ra1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="ri"><img src="ri1.jpg"  onmouseover="this.src='RI.gif'"onmouseout="this.src='ri1.jpg'" onclick="playSound(this);"/></td>
  </tr>
  <tr>
    <td class="tg-0lax" id="ru"><img src="ru1.jpg"  onmouseover="this.src='RU.gif'"onmouseout="this.src='ru1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="re"><img src="re1.jpg"  onmouseover="this.src='RE.gif'"onmouseout="this.src='re1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="ro"><img src="ro1.jpg"  onmouseover="this.src='RO.gif'"onmouseout="this.src='ro1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="wa"><img src="wa1.jpg"  onmouseover="this.src='WA.gif'"onmouseout="this.src='wa1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="wo"><img src="wo1.jpg"  onmouseover="this.src='WO.gif'"onmouseout="this.src='wo1.jpg'" onclick="playSound(this);"/></td>
    <td class="tg-0lax" id="n"><img src="n1.jpg"  onmouseover="this.src='N.gif'"onmouseout="this.src='n1.jpg'" onclick="playSound(this);"/></td>
  </tr>
</table> 
</div>
</head>

<body>
   <!-----------------------------------------------------REFERENCES-------------------------------------------------------->
<h1 id = "resources">Resources used: </h1>
    <div id = "references">
        <a href="http://www.guidetojapanese.org/learn/complete/hiragana"><strong>Sounds</strong></a>
        </br>
        <a href="https://commons.wikimedia.org/wiki/Category:Hiragana_stroke_order_(animated_image_set)"><strong>Animated gifs</strong></a>
        </br>
        <a href="https://www.tofugu.com/japanese/hiragana-chart/"><strong>Hiragana characters picture:</strong></a>
        </br>
        <a href="https://freshdesignweb.com/css-registration-form-templates/"><strong>Registration and login forms ideas</strong></a>
        </br>
    </div>   
</body>
</html>
