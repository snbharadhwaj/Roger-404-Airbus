<b>AIRBUS AEROTHON 5.0<br>
Washing Machine Database Management for Redundancy Removal</b><br><br>
<b>PROBLEM STATEMENT</b><br>
The manufacturing company ' s supply chain process generates a large amount of intermediate data from different departments, resulting in redundancy and sustainability issues. This data is consumed by other departments and submanufacturing units to plan their logistics, which leads to recalibration efforts. The intermediate data lacks authenticity and occupies valuable system memory. The goal is to provide a solution that reduces intermediate data, improves authenticity, and ensures sustainability in the long term.<br><br>
<b>OBJECTIVES</b><br>
•	Create a data lake with a normalized DB to reduce the redundancy. <br>
•	Identify the current redundant data from the forecasted data. <br>
•	Create an automation process for data stamping(approval) the real time data. <br>
•	Create a dashboard for the users in each domain to access the data required for their domain and allow the forecast and real time data creation. <br>
•	Create a dashboard for the data officer to monitor the data stamping process.<br><br>
<b>TECH STACK</b><br>
•	PHP – 8.1.18<br>
•	MySQL – 8.0.28<br>
•	Cloud - Azure MySQL flexible server<br><br>
<b>PROJECT PIPELINE</b><br>
1.	Create tables for three departments of fabrication, sub-assembly and assembly with key relationships.<br>
2.	Insert trigger for the dates between different tables so that processes don't conflict with each department.<br>
3.	Create a department table for giving unique ids to different departments as this is essential for login and approval.<br>
4.	Give a forecast data of delivery for each department and get it approved at each level to be used by the subsequent department to make it redundancy free.<br>
5.	The real- time data is stored in normalised DB of supply-chain table if the forecast data is achieved else it is recalibrated by departments.<br>
6.	A dashboard for each user to perform operations, a visualisation of forecasting, real-time data and redundancy is generated<br><br>
  <b>STEPS</b><br>
1)	Create tables fabrication, sub-assembly and assembly with the attributes, primary and foreign key relationships in MySQL. (Code in basic file in items folder)<br>
2)	Set validation and authentication for user and data to be inserted into real-time database.<br>
3)	Create front-end with dashboard for each user and all the visualisation using PHP and link it to back-end with config.php<br>
4)	Upload the entire database onto Azure MySQL cloud for data management.<br>
5)	Perform the insert and update operation through website in a hierarchy of fabricator, then sub-assembly and assembly to visualise the redundancy data being removed.<br>
6)	In the admin login, data officer can check all the departments data and monitor the forecasting, redundancy, and real-time data.<br><br>
<b>OUTCOME</b><br>
•	Redundancy removal and visualisation<br>
•	Normalised DB<br>
•	Data stamping(approval)<br>
•	Deployed on Cloud<br><br>

<b>PROJECT LINK</b><br>
https://drive.google.com/drive/folders/13A_35HbGNlIU-ncpbiJnaD0nabjQPYam?usp=sharing <br>
