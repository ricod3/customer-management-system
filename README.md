# customer-management-system
A small customer management system with PHP and CSS Framework Bootstrap

Objective:  

Develop a small customer management system for a SME (Small and Medium-sized Enterprise) that wants to have an overview of its customer data. The registered customers should be stored in the database, and it should be possible to edit the data and view an overview of the entries. Use PDO for database connection.  

   

Requirements:  

The tables should be structured as follows:  

- users: user_id, name, email, password  

- clients: company_id, company_name, contact_person, phone, address, created_by (which user created the entry), created_at (creation date), edited_at (modification date)  

- Relation: users 1 – n clients  

   

Features:  

- User registration  

- User login  

- Creation of new customers via a contact form  

- Overview of all customers  

- Ability to edit and delete each entry  

- Logged-in users can see all entries in the system  

- However, logged-in users can only edit or delete the entries they have created (Hint: This can be solved using a session).  

   

User Interface:  

- Please use one of the CSS frameworks from the CSS Frameworks module for the user interface (GUI).  

- Design the customer management system to be user-friendly, with good user feedback on contact forms and clear indications if something goes wrong.  

- Pay attention to readability, avoid distracting colors, etc., while styling.  

- Also, consider responsive design for the tool and adjust your CSS accordingly. 
