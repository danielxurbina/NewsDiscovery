<table><tr><td> <em>Assignment: </em> HW HTML5 Canvas Game</td></tr>
<tr><td> <em>Student: </em> Daniel Urbina (du35)</td></tr>
<tr><td> <em>Generated: </em> 7/2/2023 6:05:03 PM</td></tr>
<tr><td> <em>Grading Link: </em> <a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-450-M23/hw-html5-canvas-game/grade/du35" target="_blank">Grading</a></td></tr></table>
<table><tr><td> <em>Instructions: </em> <ol><li>Create a branch for this assignment called&nbsp;<em>M6-HTML5-Canvas</em></li><li>Pick a base HTML5 game from&nbsp;<a href="https://bencentra.com/2017-07-11-basic-html5-canvas-games.html">https://bencentra.com/2017-07-11-basic-html5-canvas-games.html</a></li><li>Create a folder inside public_html called&nbsp;<em>M6</em></li><li>Create an html5.html file in your M6 folder (do not put it in Project even if you're doing arcade)</li><li>Copy one of the base games (from the above link)</li><li>Add/Commit the baseline of the game you'll mod for this assignment&nbsp;<em>(Do this before you start any mods/changes)</em></li><li>Make two significant changes<ol><li>Static changes like hard-coded colors/values will not count at all (i.e., changing shapes/colors/values that are globally defined and set only once.</li><li>Direct copies of my class example changes will not be accepted (i.e., just having an AI player for pong, rotating canvas, or multi-ball unless you make a significant tweak to it)</li><li>Significant changes are things that change with game logic or modify how the game works. Static changes like hard-coded colors/values will not count at all (i.e., changing shapes/colors/values that are globally defined and set only once). You may however change such values through game logic during runtime. (i.e., when points are scored, boundaries are hit, some action occurs, etc)</li></ol></li><li>Evidence/Screenshots<ol><li>As best as you can, gather evidence for your first significant change and fill in the deliverable items below.</li><li>As best as you can, gather evidence for your significant change and fill in the deliverable items below.</li><li>Remember to include your ucid/date as comments in any screenshots that have code</li><li>Ensure your screenshots load and are visible from the md file in step 9</li></ol></li><li>In the M6 folder create a new file called m6_submission.md</li><li>Save your below responses, generate the markdown, and paste the output to this file</li><li>Add/commit/push all related files as necessary</li><li>Merge your pull request once you're satisfied with the .md file and the canvas game mods</li><li>Create a new pull request from dev to prod and merge it</li><li>Locally checkout dev and pull the merged changes from step 12</li></ol><p>Each missed or failed to follow instruction is eligible for -0.25 from the final grade</p></td></tr></table>
<table><tr><td> <em>Deliverable 1: </em> Game Info </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> What game did you pick to edit/modify?</td></tr>
<tr><td> <em>Response:</em> <p>The game that I chose to edit/modify was Collect the Squares.<br></p><br></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add the direct link to the html5.html file from Heroku Prod (i.e., https://mt85-prod.herokuapp.com/M6/html5.html)</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://du35-prod.herokuapp.com/M6/html5.html">https://du35-prod.herokuapp.com/M6/html5.html</a> </td></tr>
<tr><td> <em>Sub-Task 3: </em> Add the pull request link for this assignment from M6-HTML5-Canvas to dev</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/danielxurbina/du35-IT202-450/pull/33">https://github.com/danielxurbina/du35-IT202-450/pull/33</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 2: </em> Significant Change #1 </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Describe your change/modification</td></tr>
<tr><td> <em>Response:</em> <ul><li>Firstly, I introduced an additional target, increasing the challenge by requiring players to<br>collect two squares instead of just one.</li><li>Secondly, I enhanced the gameplay by introducing<br>color visualization to distinguish between good and bad targets. Green squares are now<br>considered good, adding to the player's score, while red squares are considered bad,<br>reducing the score when collected. This color-based distinction adds depth and excitement to<br>the game.</li></ul><br></td></tr>
<tr><td> <em>Sub-Task 2: </em> Screenshot of the change while playing (try your best as some changes may be nearly impossible to capture)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-02T21.45.31Screen%20Shot%202023-07-02%20at%205.45.20%20PM.png.webp?alt=media&token=c8ab2f1d-c1df-44e6-b870-5fd4e3d419ca"/></td></tr>
<tr><td> <em>Caption:</em> <p>Shows the changes of adding two targets with color visualization<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-02T21.49.56Screen%20Shot%202023-07-02%20at%205.49.35%20PM.png.webp?alt=media&token=8de758a1-eb70-4852-a8de-0360685c7606"/></td></tr>
<tr><td> <em>Caption:</em> <p>Starting page describing the targets and what their colors mean<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Screenshot of the relevant lines of code that implement your change (make sure your ucid and the date are shown in comments) In the caption briefly describe/explain how the code snippet works.</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-02T21.32.20Screen%20Shot%202023-07-02%20at%205.31.55%20PM.png.webp?alt=media&token=f258d825-987b-4a5a-b17f-3b3e31f37195"/></td></tr>
<tr><td> <em>Caption:</em> <p>Shows the variables used for both target variables <br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-02T21.42.19Screen%20Shot%202023-07-02%20at%205.42.04%20PM.png.webp?alt=media&token=e1ce8cab-a4be-4fe0-9e72-6b53a012c331"/></td></tr>
<tr><td> <em>Caption:</em> <p>Fills the color for the two targets (green and red)<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-02T21.43.56Screen%20Shot%202023-07-02%20at%205.43.41%20PM.png.webp?alt=media&token=8654f731-d4ae-4f1f-b293-05161bb6ee71"/></td></tr>
<tr><td> <em>Caption:</em> <p>moves the two targets at random spots in the canvas to always surprise<br>the player<br></p>
</td></tr>
</table></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 3: </em> Significant Change #2 </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Describe your change/modification</td></tr>
<tr><td> <em>Response:</em> <p>To further enhance the gaming experience, I incorporated a lives counter. Players begin<br>with three lives at the start of the game. Whenever a player collects<br>a red square, not only does their score decrease, but they also lose<br>a life. Running out of lives will signal the end of the game,<br>and the final score will be displayed.<br></p><br></td></tr>
<tr><td> <em>Sub-Task 2: </em> Screenshot of the change while playing (try your best as some changes may be nearly impossible to capture)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-02T21.59.39Screen%20Shot%202023-07-02%20at%205.58.38%20PM.png.webp?alt=media&token=5b7dfebf-a674-4dbf-be30-eb7b2b27a4d0"/></td></tr>
<tr><td> <em>Caption:</em> <p>This screenshot shows our lives counter in the top left, it also shows<br>that we start out with 3 lives<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-02T22.00.30Screen%20Shot%202023-07-02%20at%205.59.08%20PM.png.webp?alt=media&token=faeed7b7-97ca-497a-91f0-b0fc49b55538"/></td></tr>
<tr><td> <em>Caption:</em> <p>This screenshot shows what happens when we touch a red target, our lives<br>counter goes down (so does the score but in this case it&#39;s hard<br>to display that)<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-02T22.01.12Screen%20Shot%202023-07-02%20at%205.59.20%20PM.png.webp?alt=media&token=7622c048-91a4-4c23-8329-b9b7d183d0e5"/></td></tr>
<tr><td> <em>Caption:</em> <p>This screenshot shows what happens when you touch too many red targets and<br>lose all your lives, the game ends and displays your final score<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Screenshot of the relevant lines of code that implement your change (make sure your ucid and the date are shown in comments) In the caption briefly describe/explain how the code snippet works.</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-02T21.56.45Screen%20Shot%202023-07-02%20at%205.52.14%20PM.png.webp?alt=media&token=f8f2db77-f6c9-443e-b843-ddf83728da2c"/></td></tr>
<tr><td> <em>Caption:</em> <p>Variable that keeps count of the current lives<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-02T21.57.17Screen%20Shot%202023-07-02%20at%205.53.21%20PM.png.webp?alt=media&token=ec75b8b4-f141-4445-9710-97d02c4924cf"/></td></tr>
<tr><td> <em>Caption:</em> <p>This function is in charge of ending the game if the current lives<br>reaches zero<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-02T21.57.22Screen%20Shot%202023-07-02%20at%205.54.58%20PM.png.webp?alt=media&token=33246f4c-fee5-4f41-9703-471bf9343ba2"/></td></tr>
<tr><td> <em>Caption:</em> <p>This function checks for target collision and in the second if statement we<br>are checking for target 2 (the bad target). Here we decrement the currentLives<br>before moving the target again, reason because we want to end the game<br>before the user has a chance to move the target.<br></p>
</td></tr>
</table></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 4: </em> Discuss </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Talk about what you learned during this assignment and the related HTML5 Canvas readings (at least a few sentences for full credit)</td></tr>
<tr><td> <em>Response:</em> <p>Through completing this assignment and diving into the subject of HTML5 Canvas, I<br>have gained a valuable understanding: the powerful combination of HTML and JavaScript allows<br>us to create graphics using the canvas element. I found it particularly fascinating<br>to witness how a canvas can be seamlessly integrated into an HTML page,<br>enabling the implementation of various functionalities within its boundaries. It almost resembles a<br>versatile grid, where you can bring your creative ideas to life and craft<br>visually engaging elements.<br></p><br></td></tr>
</table></td></tr>
<table><tr><td><em>Grading Link: </em><a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-450-M23/hw-html5-canvas-game/grade/du35" target="_blank">Grading</a></td></tr></table>