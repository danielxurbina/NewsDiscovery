<table><tr><td> <em>Assignment: </em> IT202 Milestone 2 API Project</td></tr>
<tr><td> <em>Student: </em> Daniel Urbina (du35)</td></tr>
<tr><td> <em>Generated: </em> 7/24/2023 7:58:36 PM</td></tr>
<tr><td> <em>Grading Link: </em> <a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-450-M23/it202-milestone-2-api-project/grade/du35" target="_blank">Grading</a></td></tr></table>
<table><tr><td> <em>Instructions: </em> <ol><li>Checkout Milestone2 branch</li><li>Create a new markdown file called milestone2.md</li><li>git add/commit/push immediate</li><li>Fill in the below deliverables</li><li>At the end copy the markdown and paste it into milestone2.md</li><li>Add/commit/push the changes to Milestone2</li><li>PR Milestone2 to dev and verify</li><li>PR dev to prod and verify</li><li>Checkout dev locally and pull changes to get ready for Milestone 3</li><li>Submit the direct link to this new milestone2.md file from your GitHub prod branch to Canvas</li></ol><p>Note: Ensure all images appear properly on github and everywhere else. Images are only accepted from dev or prod, not local host. All website links must be from prod (you can assume/infer this by getting your dev URL and changing dev to prod).</p></td></tr></table>
<table><tr><td> <em>Deliverable 1: </em> Define the appropriate table or tables for your API </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshots of the table definition SQL files</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T01.20.53Screen%20Shot%202023-07-15%20at%209.39.24%20PM.png.webp?alt=media&token=8aef6de0-f440-43b4-aaf5-dc3e35503d0e"/></td></tr>
<tr><td> <em>Caption:</em> <p>Users Table: Add a new column to the &quot;Users&quot; table to store the<br>primary key of the user who created the news article<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T01.21.28Screen%20Shot%202023-07-15%20at%209.42.39%20PM.png.webp?alt=media&token=732714ba-6c03-4275-ab98-e90de69943f3"/></td></tr>
<tr><td> <em>Caption:</em> <p>Users Table: Add a new column to the &quot;Users&quot; table to store the<br>primary key of the user who created the news article<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T01.21.36Screen%20Shot%202023-07-15%20at%209.58.20%20PM.png.webp?alt=media&token=b699e76a-07ca-471d-a4c0-fc184f52e00f"/></td></tr>
<tr><td> <em>Caption:</em> <p>UserNewsInteractions Table: Showing the SQL file where the table is being created. (Didn&#39;t<br>have time to implement this but the goal was to use this table<br>to keep track of user interactions with the article, for example if someone<br>was to like an article or save it to their list of articles,<br>etc.)<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T01.21.39Screen%20Shot%202023-07-15%20at%209.59.41%20PM.png.webp?alt=media&token=24abb9a9-38bb-4917-a20b-922ef7578016"/></td></tr>
<tr><td> <em>Caption:</em> <p>UserNewsInteractions Table: Showing the individual columns of the UserNewsInteractions table.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T01.51.39Screen%20Shot%202023-07-15%20at%209.44.09%20PM.png.webp?alt=media&token=c80a22be-0166-48fe-a531-e8b688086249"/></td></tr>
<tr><td> <em>Caption:</em> <p>NewsArticles Table: Showing the SQL file where the table is being created. (This<br>is showing the table without the added edits)<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T01.53.27Screen%20Shot%202023-07-15%20at%2010.04.05%20PM.png.webp?alt=media&token=b10b7a16-74c6-4a47-b693-68952f9bca3f"/></td></tr>
<tr><td> <em>Caption:</em> <p>NewsArticles Table: Showing the SQL file where the table is being altered to<br>add two new columns for created and modified.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T01.57.18Screen%20Shot%202023-07-23%20at%209.54.39%20PM.png.webp?alt=media&token=d27d17bb-2a03-4989-8a01-4d8c7d6ea81e"/></td></tr>
<tr><td> <em>Caption:</em> <p>NewsArticles Table: Showing the SQL file where the table is being altered to<br>add a column for a boolean manual check to see if an article<br>was created manually or not<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T01.57.22Screen%20Shot%202023-07-23%20at%209.54.49%20PM.png.webp?alt=media&token=15204f53-67bb-49f1-92ad-0e5d9ce131eb"/></td></tr>
<tr><td> <em>Caption:</em> <p>NewsArticles Table: Showing the SQL file where the table is being altered to<br>add a column to hash the content to make sure that each content<br>value is not duplicate<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T01.57.27Screen%20Shot%202023-07-23%20at%209.55.10%20PM.png.webp?alt=media&token=d42b82c9-38c8-46a0-b882-8850efa6bc21"/></td></tr>
<tr><td> <em>Caption:</em> <p>NewsArticles Table: Showing the SQL file where the table is being altered to<br>modify the columns &quot;content&quot; and &quot;description&quot; to change their values to 10,000.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T01.57.30Screen%20Shot%202023-07-23%20at%209.56.05%20PM.png.webp?alt=media&token=4e4d1c5d-99a5-49ca-bc42-0d142e84d944"/></td></tr>
<tr><td> <em>Caption:</em> <p>NewsArticles Table: Showing the SQL file where the table is being altered to<br>add a column &quot;api_id&quot; to add a unique constraint to API data since<br>the API didn&#39;t have an id variable. Also modifies the columns &quot;created&quot; and<br>&quot;modified&quot; to fix the timestamps.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T01.57.33Screen%20Shot%202023-07-23%20at%209.56.18%20PM.png.webp?alt=media&token=f61e86e5-3bbc-4df4-9034-1838ff9032fc"/></td></tr>
<tr><td> <em>Caption:</em> <p>NewsArticles Table: Showing the SQL file where the table is being modified to<br>change the values of the columns to 500.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T01.57.36Screen%20Shot%202023-07-23%20at%209.56.34%20PM.png.webp?alt=media&token=754bebfa-f03c-41f7-b0d5-214f452194af"/></td></tr>
<tr><td> <em>Caption:</em> <p>NewsArticles Table: Showing the SQL file where the table is being modified to<br>change the values of the columns &quot;content_description&quot; and &quot;content&quot; to TEXT.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T01.57.40Screen%20Shot%202023-07-23%20at%209.56.42%20PM.png.webp?alt=media&token=5be4d231-8888-4907-a0c1-3583c11d2bf0"/></td></tr>
<tr><td> <em>Caption:</em> <p>NewsArticles Table: Showing the SQL file where the table is adding a UNIQUE<br>value to both &quot;content_hash&quot; and &quot;title&quot; to combat duplicate values from entering the<br>table.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Mappings</td></tr>
<tr><td> <em>Response:</em> <ol><br><li><strong>NewsArticles Table:</strong><br><ul><br><li><strong>id:</strong> This is the primary key of the NewsArticles table, serving as<br>a unique identifier for each article.</li><br><li><strong>title:</strong> Stores the title value, whether it comes<br>from the API or is manually inputted.</li><br><li><strong>link:</strong> Stores the link of the news<br>article, obtained from the API or manually entered.</li><br><li><strong>video_url:</strong> Stores the link of a<br>video related to the news article, fetched from the API or manually added.</li><br><li><strong>content_description:</strong><br>Holds the description of the news article, retrieved from the API or manually<br>provided.</li><br><li><strong>content:</strong> Stores the content of the news article, whether from the API or<br>manually entered.</li><br><li><strong>publish_date:</strong> Records the date of the news article, either from the API<br>or manually entered.</li><br><li><strong>image_url:</strong> Stores the image associated with the news article, fetched from<br>the API or manually added.</li><br><li><strong>source_id:</strong> Represents the source of the news article, obtained<br>from the API or manually specified.</li><br><li><strong>category:</strong> Indicates the category of the news article,<br>obtained from the API or manually specified.</li><br><li><strong>country:</strong> Indicates the country of the news<br>article, obtained from the API or manually specified.</li><br><li><strong>created_by:</strong> Stores the ID of the<br>user who created the article. This field is applicable only for manually inputted<br>articles.</li><br><li><strong>created:</strong> Records the timestamp when the article was added to the database.</li><br><li><strong>modified:</strong> Records<br>the timestamp when the article was last modified in the database.</li><br><li><strong>manual_check:</strong> A boolean<br>value to determine whether the article was manually inputted or fetched from the<br>API.</li><br><li><strong>content_hash:</strong> Stores the hash value of the content to ensure uniqueness and avoid<br>duplication.</li><br><li><strong>api_id:</strong> This field is used to store the generated ID for articles fetched<br>from the API. It helps ensure each article fetched is unique and also<br>distinguishes API-fetched articles from manually inputted ones.</li><br></ul><br></li><br><li><strong>UserNewsInteractions Table:</strong><em>(Note: This table was planned but<br>not yet implemented in the project.)</em><br><ul><br><li><strong>id:</strong> This is the primary key of the<br>UserNewsInteractions table, serving as a unique identifier for each individual interaction.</li><br><li><strong>user_id:</strong> Stores the<br>ID of the user who made the interaction.</li><br><li><strong>news_id:</strong> Stores the ID of the<br>news article involved in the interaction.</li><br><li><strong>interaction_type:</strong> Indicates the type of interaction made by<br>the user (e.g., comment, like, save).</li><br><li><strong>created:</strong> Records the timestamp when the interaction was<br>appended to the database.</li><br><li><strong>modified:</strong> Records the timestamp when the interaction was last modified<br>in the database.</li><br></ul><br></li><br><li><strong>Users Table:</strong><em>(Note: This column was planned but not yet implemented in<br>the project.)</em><br><ul><br><li><strong>Disclaimer:</strong> The Users table is intended to store user data. A column<br>called <strong><code>created_articles</code></strong> was added, serving as a foreign key constraint that must correspond<br>to an existing ID in the NewsArticles table. This helps maintain data integrity<br>and prevents orphaned data in the Users table, where the <strong><code>created_articles</code></strong> value would<br>point to a non-existing article in the NewsArticles table. This column is intended<br>to be utilized in future implementations to track the articles created by each<br>user.</li></ul></li></ol><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add any related PRs for this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/danielxurbina/du35-IT202-450/pull/61">https://github.com/danielxurbina/du35-IT202-450/pull/61</a> </td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/danielxurbina/du35-IT202-450/pull/62">https://github.com/danielxurbina/du35-IT202-450/pull/62</a> </td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/danielxurbina/du35-IT202-450/pull/66">https://github.com/danielxurbina/du35-IT202-450/pull/66</a> </td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/danielxurbina/du35-IT202-450/pull/71">https://github.com/danielxurbina/du35-IT202-450/pull/71</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 2: </em> Data Creation Page </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshots of the Page and the Code (at least two)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T03.21.24Screen%20Shot%202023-07-23%20at%2011.14.23%20PM.png.webp?alt=media&token=2d70f0db-6688-4842-af64-b0c5f49b3cde"/></td></tr>
<tr><td> <em>Caption:</em> <ol>
<li>This example displays a fully completed article with accurate data, representing a<br>valid form submission. As there was no video URL provided in the news<br>article, and it is an optional field, it remains blank in the form.<br></li>
</ol>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T03.22.10Screen%20Shot%202023-07-23%20at%2011.16.14%20PM.png.webp?alt=media&token=8cd12779-9b9f-44e8-9cec-8d04d2ab5a75"/></td></tr>
<tr><td> <em>Caption:</em> <ol start="2">
<li>This demonstrates the successful submission of the article, indicated by the message<br>displayed on the screen.<br></li>
</ol>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T03.22.14Screen%20Shot%202023-07-23%20at%2011.20.34%20PM.png.webp?alt=media&token=a866d6fc-8dc1-4d61-858d-956e61909ac1"/></td></tr>
<tr><td> <em>Caption:</em> <ol start="3">
<li>This serves as evidence of the successful article submission, as you can<br>observe the article now present in the database with the ID #35.<br></li>
</ol>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T03.22.18Screen%20Shot%202023-07-23%20at%2011.18.15%20PM.png.webp?alt=media&token=5e146e90-97df-4e61-9411-6db14beaed6c"/></td></tr>
<tr><td> <em>Caption:</em> <ol start="4">
<li>This demonstrates the form fields with errors in both the date and<br>title fields.<br></li>
</ol>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T03.22.21Screen%20Shot%202023-07-23%20at%2011.19.15%20PM.png.webp?alt=media&token=a42f8f49-d6f8-4d3b-8924-9a03602884e2"/></td></tr>
<tr><td> <em>Caption:</em> <ol start="5">
<li>This displays the error messages generated from leaving the title blank and<br>entering an incorrect date format.<br></li>
</ol>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Database Results</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T03.44.29Screen%20Shot%202023-07-23%20at%2011.42.23%20PM.png.webp?alt=media&token=8b002035-22cc-4e14-907a-e54f0aef9294"/></td></tr>
<tr><td> <em>Caption:</em> <p>This displays the data of manually created items. An item is considered manually<br>created when the &quot;manual_check&quot; field is set to true. Conversely, if the &quot;manual_check&quot;<br>field is set to false, it indicates that the item was not manually<br>created.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T03.44.35Screen%20Shot%202023-07-23%20at%2011.42.50%20PM.png.webp?alt=media&token=eb6eeead-43d8-4c86-98a5-8bd647ac9bb5"/></td></tr>
<tr><td> <em>Caption:</em> <p>This section displays data for API-created items. An item is considered API-created when<br>the &quot;manual_check&quot; field is set to false or null.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Misc Checklist</td></tr>
<tr><td> <em>Response:</em> <p>Entities in the system are made unique through several mechanisms. Firstly, the "id"<br>column serves as the PRIMARY key for each article, ensuring that every entry<br>has a distinct identifier. To further enforce uniqueness, a "content_hash" column is employed,<br>which hashes the news content to guarantee uniqueness and prevent duplicates. Additionally, UNIQUE<br>constraints are applied to both the "content_hash" and "title" columns, ensuring that the<br>database disallows duplicate titles or content. Moreover, the "api_id" field is utilized for<br>articles fetched from the API, providing a unique identifier since the API data<br>lacks its own ID value.</p><br><p>Handling duplicate values for both manually added items and<br>API-fetched items involves the same approach. The content is hashed and compared against<br>existing entries in the "content_hash" column. If a match is found, the system<br>recognizes the article as a duplicate and takes appropriate actions, such as preventing<br>insertion or notifying the user.</p><br><p>As for entity creation access, all users, irrespective of<br>role, have the privilege to create articles. This inclusive approach allows any user<br>to contribute to the site by not only enjoying news content but also<br>sharing their own news articles.</p><p><br></p><br></td></tr>
<tr><td> <em>Sub-Task 4: </em> Add a direct link to this file on Heroku Prod</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://du35-prod.herokuapp.com/Project/news_article_creation.php">https://du35-prod.herokuapp.com/Project/news_article_creation.php</a> </td></tr>
<tr><td> <em>Sub-Task 5: </em> Add any related PRs for this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/danielxurbina/du35-IT202-450/pull/63">https://github.com/danielxurbina/du35-IT202-450/pull/63</a> </td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/danielxurbina/du35-IT202-450/pull/67">https://github.com/danielxurbina/du35-IT202-450/pull/67</a> </td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/danielxurbina/du35-IT202-450/pull/71">https://github.com/danielxurbina/du35-IT202-450/pull/71</a> </td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/danielxurbina/du35-IT202-450/pull/74">https://github.com/danielxurbina/du35-IT202-450/pull/74</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 3: </em> Data List Page </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshot the list page and code</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T04.48.36Screen%20Shot%202023-07-24%20at%2012.39.48%20AM.png.webp?alt=media&token=c7acbd30-6bc2-4370-b9ce-f290fee6b8e0"/></td></tr>
<tr><td> <em>Caption:</em> <p>This page showcases articles generated from the database. It features an input field<br>to search for specific articles and a toggle button to access a form<br>where users can specify the number of articles they want to view on<br>the page. Differentiating between API-generated and manually-created articles, the page includes distinct buttons<br>for each type. Administrators have the privilege to edit and delete both API<br>and manually-created articles. On the other hand, non-admin users will only see edit<br>and delete buttons for their own manually-created articles.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T04.48.44Screen%20Shot%202023-07-24%20at%2012.40.21%20AM.png.webp?alt=media&token=b1b7a927-e648-4479-8dbd-fc6cb2286614"/></td></tr>
<tr><td> <em>Caption:</em> <p>This page displays an additional article fetched from the database and presented on<br>the page. Given more time, I would enhance the styling to showcase the<br>articles in a grid layout, making them more visually appealing and easier to<br>browse.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T04.48.47Screen%20Shot%202023-07-24%20at%2012.43.25%20AM.png.webp?alt=media&token=6bcfd418-b3ca-4c4f-9ac8-bcf55936240d"/></td></tr>
<tr><td> <em>Caption:</em> <p>This page demonstrates the toggle being switched and the correct number entered in<br>the input field to limit the number of articles displayed on the page.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T04.48.52Screen%20Shot%202023-07-24%20at%2012.43.41%20AM.png.webp?alt=media&token=8b3644b6-60d9-4a11-8a6e-d94e572c92fb"/></td></tr>
<tr><td> <em>Caption:</em> <p>This page demonstrates a successful outcome of limiting the number of articles displayed<br>on the page by correctly showing the two articles previously inputted in the<br>input field.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T04.48.56Screen%20Shot%202023-07-24%20at%2012.43.57%20AM.png.webp?alt=media&token=e0b15684-9540-4df9-b11b-429e6a729f7c"/></td></tr>
<tr><td> <em>Caption:</em> <p>This page displays the correct input, resulting in a valid search result from<br>the database.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T04.49.04Screen%20Shot%202023-07-24%20at%2012.44.09%20AM.png.webp?alt=media&token=975de4fe-bb30-4c71-b12f-05fed1e6bbe7"/></td></tr>
<tr><td> <em>Caption:</em> <p>This page displays the article that was searched for based on the previous<br>search input.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T04.49.20Screen%20Shot%202023-07-24%20at%2012.44.30%20AM.png.webp?alt=media&token=27a4beda-e57f-450e-aa7e-53d4f147c541"/></td></tr>
<tr><td> <em>Caption:</em> <p>This page demonstrates what happens when the wrong input is entered in the<br>search bar, which results in an error message being displayed.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T04.49.23Screen%20Shot%202023-07-24%20at%2012.44.44%20AM.png.webp?alt=media&token=92b42325-dc0f-4151-8134-0eef73e2c82a"/></td></tr>
<tr><td> <em>Caption:</em> <p>This page displays the error message that appears due to the previous search<br>input. The error message is shown because there was no title in the<br>database that matched the search term &quot;School.&quot;<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T04.49.41Screen%20Shot%202023-07-24%20at%2012.45.04%20AM.png.webp?alt=media&token=ba060d1c-f44e-4d9f-9833-1c0ca75efd92"/></td></tr>
<tr><td> <em>Caption:</em> <p>On this page, when toggling the button to input an incorrect number of<br>articles to display, it will trigger the appearance of an error message on<br>the screen.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T04.49.29Screen%20Shot%202023-07-24%20at%2012.46.10%20AM.png.webp?alt=media&token=e9b42d15-db04-42e1-bd11-330a3d5f3503"/></td></tr>
<tr><td> <em>Caption:</em> <p>This page shows the error message that appears when an incorrect article limit<br>is entered in the input field.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Explanation</td></tr>
<tr><td> <em>Response:</em> <p>The home page, displaying all articles, doesn't require any specific roles for access.<br>However, users must be logged in to view the articles. If a user<br>is not logged in, an error message appears, redirecting them to the login<br>page for authentication.</p><br><p>For users with an admin role, they have full editing and<br>deletion privileges for any article, including their own. On the other hand, non-admin<br>users can only edit and delete their own articles. They can see a<br>"read more" button for all articles, but not the edit and delete buttons,<br>whether they are API-fetched or manually created.</p><br><p>The articles on the page are listed<br>in descending order, ensuring that the latest news is always presented first. To<br>further enhance user experience, various filters and searching options are available. Users can<br>input a specific number to limit the displayed articles or search using keywords<br>and topics of interest. If no search result is found, an informative error<br>message stating "No article was found" is displayed.</p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add a direct link to this file on Heroku Prod</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://du35-prod.herokuapp.com/Project/home.php">https://du35-prod.herokuapp.com/Project/home.php</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Add any related PRs for this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/danielxurbina/du35-IT202-450/pull/68">https://github.com/danielxurbina/du35-IT202-450/pull/68</a> </td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/danielxurbina/du35-IT202-450/pull/72">https://github.com/danielxurbina/du35-IT202-450/pull/72</a> </td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/danielxurbina/du35-IT202-450/pull/74">https://github.com/danielxurbina/du35-IT202-450/pull/74</a> </td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/danielxurbina/du35-IT202-450/pull/75">https://github.com/danielxurbina/du35-IT202-450/pull/75</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 4: </em> View Details Page </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshot of Page and related content/code</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T05.36.55Screen%20Shot%202023-07-24%20at%201.35.11%20AM.png.webp?alt=media&token=3364d1af-6970-44ee-8e39-3e55303a25d3"/></td></tr>
<tr><td> <em>Caption:</em> <p>This page showcases individual articles, displaying comprehensive data associated with each article. The<br>content is fetched dynamically based on the article&#39;s unique ID, which is extracted<br>from the URL.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T05.36.58Screen%20Shot%202023-07-24%20at%201.35.51%20AM.png.webp?alt=media&token=7cc2cf24-233a-47b0-8343-4f960f7f65fd"/></td></tr>
<tr><td> <em>Caption:</em> <p>This page demonstrates what happens when an incorrect ID is entered in the<br>URL, leading to an error being displayed.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T05.37.01Screen%20Shot%202023-07-24%20at%201.36.05%20AM.png.webp?alt=media&token=2b5a6413-5164-488d-abb4-8f58744755d5"/></td></tr>
<tr><td> <em>Caption:</em> <p>This page displays the error message that appears when an incorrect ID is<br>entered in the URL.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Explanation</td></tr>
<tr><td> <em>Response:</em> <p>In each individual article page, additional details are displayed, including the full content<br>of the article, its source, category, country of origin, and the date it<br>was published. The visibility of the edit and delete links on the article<br>details page is determined by two factors: if a user has an Admin<br>role, they will see the edit and delete links on every individual article<br>page. Conversely, if a user doesn&#39;t have an Admin role, they will only<br>see the edit and delete links on the individual article pages that they<br>created.<br></p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add a direct link to this file on Heroku Prod</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://du35-prod.herokuapp.com/Project/article_details.php?id=30">https://du35-prod.herokuapp.com/Project/article_details.php?id=30</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Add any related PRs for this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/danielxurbina/du35-IT202-450/pull/69">https://github.com/danielxurbina/du35-IT202-450/pull/69</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 5: </em> Edit Data Page </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshot of Page and related content/code</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T05.50.59Screen%20Shot%202023-07-24%20at%201.46.53%20AM.png.webp?alt=media&token=5fc901d2-72d7-4da9-a8b8-ce2b4be7cebb"/></td></tr>
<tr><td> <em>Caption:</em> <p>This page presents the article editing interface and successfully covers the following aspects:<br><br>1.<br>The screenshot includes the URL, showcasing the specific article being edited.<br>2. It demonstrates<br>that the data is fetched based on the ID passed through the query<br>parameters in the URL.<br>3. The page is appropriately styled, providing a visually appealing<br>user interface.<br>4. The form design resembles the create page, ensuring consistency throughout the<br>application.<br>5. The form is prefilled with the data fetched from the database, saving<br>the user&#39;s time and effort.<br>6. Each form field has the correct data types,<br>ensuring accurate data entry for each property.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T05.56.58Screen%20Shot%202023-07-24%20at%201.56.40%20AM.png.webp?alt=media&token=e404237b-18c0-40b2-9079-50c5eac4195b"/></td></tr>
<tr><td> <em>Caption:</em> <p>This page demonstrates incorrect data being entered into the input fields. For instance,<br>the title is left empty, and the date has an incorrect date format.<br>As a consequence, an error message is displayed to notify the user about<br>the issues.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T05.57.01Screen%20Shot%202023-07-24%20at%201.56.53%20AM.png.webp?alt=media&token=5baed445-a4e2-402c-a427-b726a97cb85f"/></td></tr>
<tr><td> <em>Caption:</em> <p>This page displays the error messages that resulted from leaving the title field<br>empty and entering the wrong date format.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T06.04.59Screen%20Shot%202023-07-24%20at%202.03.14%20AM.png.webp?alt=media&token=a8dd9c9f-8d6b-48b9-b06a-16e5bdbf5596"/></td></tr>
<tr><td> <em>Caption:</em> <p>This page displays the individual article page prior to the updates.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T06.05.01Screen%20Shot%202023-07-24%20at%202.04.36%20AM.png.webp?alt=media&token=9f360786-2fd2-4e8f-9914-3c029c3e65f7"/></td></tr>
<tr><td> <em>Caption:</em> <p>This page displays the edit form with the updated changes entered in the<br>form fields.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T06.05.11Screen%20Shot%202023-07-24%20at%202.04.49%20AM.png.webp?alt=media&token=3ae99c13-1d32-4ae4-9861-11e394868be5"/></td></tr>
<tr><td> <em>Caption:</em> <p>This page displays the updated changes on the individual article page.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T23.16.42Screen%20Shot%202023-07-24%20at%207.15.16%20PM.png.webp?alt=media&token=79130299-3ac5-42dc-b891-a1fdf606076a"/></td></tr>
<tr><td> <em>Caption:</em> <p>This page demonstrates the user entering the wrong ID in the URL which<br>will generate an error message.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T23.16.45Screen%20Shot%202023-07-24%20at%207.15.29%20PM.png.webp?alt=media&token=92ebd10a-82cd-4535-b992-01261ae89e4f"/></td></tr>
<tr><td> <em>Caption:</em> <p>This page demonstrates the display of an error message when an invalid ID<br>is entered in the URL.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a direct link to this file on Heroku Prod</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://du35-prod.herokuapp.com/Project/article_edit.php?id=30">https://du35-prod.herokuapp.com/Project/article_edit.php?id=30</a> </td></tr>
<tr><td> <em>Sub-Task 3: </em> Add any related PRs for this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/danielxurbina/du35-IT202-450/pull/73">https://github.com/danielxurbina/du35-IT202-450/pull/73</a> </td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/danielxurbina/du35-IT202-450/pull/74">https://github.com/danielxurbina/du35-IT202-450/pull/74</a> </td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/danielxurbina/du35-IT202-450/pull/77">https://github.com/danielxurbina/du35-IT202-450/pull/77</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 6: </em> Delete Handling </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshots of related code/evidence</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T06.20.18Screen%20Shot%202023-07-24%20at%202.10.43%20AM.png.webp?alt=media&token=2a3e9dd3-7e2c-4094-87c5-8c019e97da88"/></td></tr>
<tr><td> <em>Caption:</em> <p>This page shows the delete article confirmation and a preview of what is<br>going to be deleted.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T06.20.27Screen%20Shot%202023-07-24%20at%202.11.19%20AM.png.webp?alt=media&token=824f5966-5122-4351-a413-a59c00afa2af"/></td></tr>
<tr><td> <em>Caption:</em> <p>This page shows an incorrect ID being entered in the URL, resulting in<br>an error message.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T06.20.30Screen%20Shot%202023-07-24%20at%202.11.32%20AM.png.webp?alt=media&token=892fa13c-a50e-4a10-9af5-824f6080fa67"/></td></tr>
<tr><td> <em>Caption:</em> <p>This page demonstrates the error message that was generated from an incorrect ID<br>being passed into the URL.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T06.20.35Screen%20Shot%202023-07-24%20at%202.13.17%20AM.png.webp?alt=media&token=f92cdad7-afbf-4ef2-9842-28ac2398296c"/></td></tr>
<tr><td> <em>Caption:</em> <p>This screenshot demonstrates on how the article is being deleted.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T06.20.37Screen%20Shot%202023-07-24%20at%202.14.08%20AM.png.webp?alt=media&token=7c90a94b-3578-41df-8238-e0e618860709"/></td></tr>
<tr><td> <em>Caption:</em> <p>This page shows the delete article confirmation and a preview of what is<br>going to be deleted ((ID #34). <strong>This is similar to the other screenshot<br>but this is to demonstrate when the user clicks the button it will<br>generate a user friendly message that the deletion was successful</strong><br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T06.20.39Screen%20Shot%202023-07-24%20at%202.14.24%20AM.png.webp?alt=media&token=4ae5367a-6618-4a9c-8c2c-6acfde2fbfd2"/></td></tr>
<tr><td> <em>Caption:</em> <p>This page demonstrates that the deletion was successful by generating a user friendly<br>message.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T06.20.46Screen%20Shot%202023-07-24%20at%202.16.22%20AM.png.webp?alt=media&token=92a2ced9-802c-481b-8173-2480be8b5825"/></td></tr>
<tr><td> <em>Caption:</em> <p>This table is showing that the article with ID #34 was successfully deleted<br>from the datbase.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T23.18.45Screen%20Shot%202023-07-24%20at%207.17.34%20PM.png.webp?alt=media&token=5f14550f-a009-44df-9b35-22124809e5b9"/></td></tr>
<tr><td> <em>Caption:</em> <p>This page shows the filter being applied <br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T23.18.47Screen%20Shot%202023-07-24%20at%207.17.53%20PM.png.webp?alt=media&token=174780fc-bf9e-498a-be62-28d9ef0426a3"/></td></tr>
<tr><td> <em>Caption:</em> <p>This page demonstrates the functionality of the filter search, where three articles are<br>submitted and displayed. The display might be slightly obscured due to the current<br>styling, but you can see the three articles listed.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T23.18.50Screen%20Shot%202023-07-24%20at%207.18.07%20PM.png.webp?alt=media&token=06dd9762-a384-4118-9faf-41d844e5e3ab"/></td></tr>
<tr><td> <em>Caption:</em> <p>This page shows the delete article page.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T23.18.54Screen%20Shot%202023-07-24%20at%207.18.22%20PM.png.webp?alt=media&token=b2322cc3-c1be-4fbb-9790-32e6746bf199"/></td></tr>
<tr><td> <em>Caption:</em> <p>This page demonstrates the successful deletion of the article. After deletion, the user<br>is automatically redirected to the home page. What&#39;s noteworthy is that the filter<br>applied earlier remains intact, as evident from the comparison between this image and<br>the subsequent one displaying three articles.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T23.18.57Screen%20Shot%202023-07-24%20at%207.18.30%20PM.png.webp?alt=media&token=5f3f7e7b-9f6a-4664-9b4f-a8df5702c22d"/></td></tr>
<tr><td> <em>Caption:</em> <p>This page demonstrates the successful deletion of the article. After deletion, the user<br>is automatically redirected to the home page. What&#39;s noteworthy is that the filter<br>applied earlier remains intact, as evident from the comparison between this image and<br>the subsequent one displaying three articles.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Explanation</td></tr>
<tr><td> <em>Response:</em> <p>The roles and permissions required for deleting an article depend on whether the<br>user has an Admin role. If the user is an Admin, they have<br>the privilege to delete any article within the application. However, for non-Admin users,<br>they are only allowed to delete articles that they have created themselves.</p><br><p>The deletion<br>process begins by extracting the ID from the URL, which is then used<br>in an SQL query to retrieve the corresponding article. Once the article is<br>retrieved, the server checks if the request method is a POST method using<br><strong><code>$_SERVER['REQUEST_METHOD'] == 'POST'</code></strong>. Subsequently, the helper function "delete_data" is called with two parameters:<br>the table and the ID of the article. The function then handles the<br>deletion process, which is a hard delete, permanently removing the article from the<br>database.</p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add any related PRs for this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/danielxurbina/du35-IT202-450/pull/70">https://github.com/danielxurbina/du35-IT202-450/pull/70</a> </td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/danielxurbina/du35-IT202-450/pull/77">https://github.com/danielxurbina/du35-IT202-450/pull/77</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 7: </em> API Handling </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshots of Code</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T07.28.05Screen%20Shot%202023-07-24%20at%203.21.36%20AM.png.webp?alt=media&token=08cb7b6c-0750-479f-82ea-990a11b8510b"/></td></tr>
<tr><td> <em>Caption:</em> <p>This page demonstrates the process of fetching API data by clicking this button.<br>Upon clicking, the button initiates a call to the API, effectively refreshing the<br>database with the most recent articles.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T07.28.09Screen%20Shot%202023-07-24%20at%203.23.11%20AM.png.webp?alt=media&token=31480aa7-fa56-4ed7-99a1-5ce564d07cea"/></td></tr>
<tr><td> <em>Caption:</em> <p>import_api_data.php: This demonstrates how the API is being fetched from the server side.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T07.28.13Screen%20Shot%202023-07-24%20at%203.23.35%20AM.png.webp?alt=media&token=3457dfac-dd2f-443b-8f1b-ac9dd4026cf8"/></td></tr>
<tr><td> <em>Caption:</em> <p>import_api_data.php: This demonstrates how the API is being fetched from the server side.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T07.28.16Screen%20Shot%202023-07-24%20at%203.23.58%20AM.png.webp?alt=media&token=b48d350e-36a0-4497-b305-8ef9a6b4902f"/></td></tr>
<tr><td> <em>Caption:</em> <p>import_api_data.php: This demonstrates how the API is being fetched from the server side.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T07.28.19Screen%20Shot%202023-07-24%20at%203.24.09%20AM.png.webp?alt=media&token=cca3fcaa-3809-4b6b-9cf4-5579de3b2d13"/></td></tr>
<tr><td> <em>Caption:</em> <p>import_api_data.php: This demonstrates how the API is being fetched from the server side.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T07.31.35Screen%20Shot%202023-07-24%20at%203.31.23%20AM.png.webp?alt=media&token=42db9938-804f-4a4d-a593-874c736035d8"/></td></tr>
<tr><td> <em>Caption:</em> <p>data_mapping.php: This illustrates how the application is mapping the data to the database<br>and effectively handling duplicates using the content_hash mechanism.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Explanation</td></tr>
<tr><td> <em>Response:</em> <p>The API to DB mapping process is a crucial aspect of integrating external<br>data into the application's database. In our implementation, this process occurs within the<br><strong><code>map_data</code></strong> function, housed in the <strong><code>data_mapping.php</code></strong> file. Let's take a closer look at<br>how it works:</p><br><ol><br><li><strong>Data Transformation:</strong> When data is retrieved from the API, it's in<br>a specific format that might not directly align with our database structure. The<br><strong><code>map_data</code></strong> function takes care of transforming the API data into a format suitable<br>for insertion into the database.</li><br><li><strong>Attribute Extraction:</strong> Within the <strong><code>map_data</code></strong> function, a loop iterates<br>through each article in the API data. For each article, relevant attributes such<br>as title, link, video URL, description, content, publish date, image URL, source ID,<br>category, and country are extracted.</li><br><li><strong>Unique API ID Generation:</strong> As part of the mapping<br>process, a unique API ID is generated for each article. This is achieved<br>using the <strong><code>uniqid()</code></strong> function, ensuring that every article fetched from the API is<br>assigned a distinct identifier in the database.</li><br><li><strong>Handling Duplicates:</strong> To avoid duplicate entries in<br>the database, we compute a content hash for each article's content. The SHA-256<br>hashing algorithm is utilized to generate a unique hash for each article's content.<br>This way, articles with identical content are detected and prevented from being inserted<br>multiple times.</li><br><li><strong>Creating an Array of Records:</strong> After processing all the articles, the <strong><code>map_data</code></strong><br>function constructs an array of records. Each record in the array contains the<br>mapped data for an individual article, including the unique API ID and content<br>hash.</li><br><li><strong>Ready for Database Insertion:</strong> The final array of mapped data is now ready<br>to be inserted or updated into the database. This process ensures data integrity<br>and uniqueness, essential for maintaining a well-structured and reliable database.</li><br></ol><br><p>Additionally, to control API<br>calls' frequency and avoid unnecessary requests, the Admin user manually triggers the "Refresh<br>News Articles" button. By doing so, we prevent exceeding API quota limits and<br>optimize data retrieval efficiency.</p><br><p>The retrieved API data plays a central role in populating<br>the homepage with the latest news articles, allowing users to stay up-to-date with<br>current events.</p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add any related PRs for this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/danielxurbina/du35-IT202-450/pull/65">https://github.com/danielxurbina/du35-IT202-450/pull/65</a> </td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/danielxurbina/du35-IT202-450/pull/66">https://github.com/danielxurbina/du35-IT202-450/pull/66</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 8: </em> Misc </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> What issues did you face and overcome during this milestone?</td></tr>
<tr><td> <em>Response:</em> <p>During this Milestone, I encountered some challenges that ultimately became valuable learning experiences.<br>One significant hurdle was implementing the article creation functionality from scratch, without relying<br>on video tutorials or external guidance. It was my first time attempting this,<br>and I had to grapple with various aspects of the process. However, with<br>determination and perseverance, I managed to overcome the obstacles and successfully implement the<br>article creation feature.</p><br><p>Additionally, integrating the API with the database posed another challenge. As<br>I had never worked with APIs before, I needed to familiarize myself with<br>the concepts and learn how to establish a connection between the API and<br>the database. It required understanding the data format from the API and devising<br>a suitable approach to map and store the data in the database accurately.</p><br><p>In<br>the face of these challenges, I decided to take a proactive approach to<br>learning. I delved into relevant documentation, online resources, and sought help from online<br>communities to gain insights and solutions to the issues at hand.</p><br><p>As a result<br>of these challenges, I now feel more confident in my abilities and have<br>acquired valuable knowledge and expertise in implementing article creation functionality and integrating APIs<br>into applications.</p><br></td></tr>
<tr><td> <em>Sub-Task 2: </em> What did you find the easiest?</td></tr>
<tr><td> <em>Response:</em> <p>During this Milestone, I found the edit page and viewing individual articles to<br>be the most straightforward tasks. The reason behind this ease was that they<br>built upon the work I had already completed earlier in the project. As<br>a result, I didn't need to write extensive code or implement entirely new<br>functionalities.</p><br><p>The edit page was relatively smooth to create since I could leverage the<br>existing form structure and simply populate it with the article's current data. This<br>way, users could easily update the article details without much hassle. Building upon<br>the foundation I had established earlier allowed for a seamless editing experience.</p><br><p>Similarly, viewing<br>individual articles proved to be a straightforward process. By utilizing the data mapping<br>and fetching mechanisms already in place, I was able to display detailed information<br>about each article with minimal additional code. The ability to reuse and adapt<br>existing components contributed to the efficiency of this task.</p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> What did you find the hardest?</td></tr>
<tr><td> <em>Response:</em> <p>During this Milestone, connecting the database to the API proved to be the<br>most challenging aspect for me. As I had never worked with an API<br>before, I initially felt overwhelmed and lost. However, I was determined to overcome<br>this obstacle and invested countless hours into understanding the necessary steps.</p><br><p>At first, setting<br>up the API key posed a minor challenge. I needed to ensure that<br>the key was properly configured and authenticated to access the API data. Once<br>I had resolved this issue, the next hurdle was efficiently retrieving and mapping<br>the API data to the database.</p><br><p>Through perseverance and a deep dive into API<br>documentation, I gradually grasped the concepts and techniques required for successful integration. As<br>I progressed, I gained valuable insights into handling API requests and responses, data<br>mapping, and managing duplicates through content hashing</p><br></td></tr>
<tr><td> <em>Sub-Task 4: </em> Did you have to utilize any unanticipated APIs?</td></tr>
<tr><td> <em>Response:</em> <p>During the development of the project, I did not need to utilize any<br>unanticipated APIs. This was primarily due to the meticulous planning and research conducted<br>before starting the project. At the initial stages, I thoroughly analyzed the project<br>requirements and scope, which helped me identify all the necessary APIs to be<br>integrated.<br></p><br></td></tr>
<tr><td> <em>Sub-Task 5: </em> Add a screenshot of your project board</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdu35%2F2023-07-24T23.56.43Screen%20Shot%202023-07-24%20at%207.56.38%20PM.png.webp?alt=media&token=66368668-65bd-4a48-9481-8c63635d5a57"/></td></tr>
<tr><td> <em>Caption:</em> <p>This page displays the current state of the project board.<br></p>
</td></tr>
</table></td></tr>
</table></td></tr>
<table><tr><td><em>Grading Link: </em><a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-450-M23/it202-milestone-2-api-project/grade/du35" target="_blank">Grading</a></td></tr></table>