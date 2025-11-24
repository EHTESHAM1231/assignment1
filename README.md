# CHT2520 Assignment 1 U2366447 Muhammad Ehtesham Siddiqui

## 1. Introduction & Scenario

For this assignment, I created a simple web application called Skill Swap Hub. The goal of the application is to allow users to share a skill they have and connect with others who may be interested in learning it. This scenario is unique, practical, and fits the assignment requirement of using a single database table.

The Skill Swap Hub stores information about different skill set offers. Each offer contains:

- Provider’s name  
- Skill they are offering  
- Expertise level  
- Teaching mode (online or in person)  
- Contact information  
- Optional availability notes  

Users can:

- View all skill offers  
- Search through offers  
- Create new entries  
- Edit existing ones  
- Delete offers  

Although the application is minimalistic, it provides a real-world example of how communities or clubs could swap skills without money. More importantly, it demonstrates my understanding of the Laravel framework and its core features, which is the main goal of the assignment.



## 2. MVC Design Pattern in My Application

Laravel is built using the Model-View-Controller (MVC) design pattern. I applied MVC correctly and consistently throughout my project.

### Model  Handling the Data

The model used in this project is SkillOffer, representing the single database table.

- Defines which fields are mass assignable using the $fillable array  
- Protects against mass-assignment vulnerabilities  
- Uses Laravel’s Eloquent ORM for database interaction  

### View — Displaying the Interface

All user interfaces are built using Blade templates located in:  
`resources/views/skill_offers/`

Examples:

- index.blade.php — shows paginated list of skill offers  
- create.blade.php — form to create a new offer  
- edit.blade.php — form to edit existing offers  
- show.blade.php — full details of a single skill offer  

All views extend a shared layout:  
`layouts/app.blade.php`

I used simple custom CSS located in:  
`public/css/styles.css`

Since no CSS frameworks or JavaScript were allowed, the design is clean and accessible.

### Controller — Application Logic

The controller (SkillOfferController) handles all logic between the model and views.

Key examples:

- index() — retrieves and passes data to the view  
- store() & `update() — validate user input before storing it  
- destroy() — deletes entries safely  
- create() & `edit() — return the form views  

This keeps the MVC structure clean:

- Views contain no data logic  
- Models contain no display logic  
- Controller  manages all decision-making  



## 3. Good Practices Used in My Application

Throughout development, I followed several good Laravel and general web development practices.

### Database Migrations & Seeders

- Created a migration for the skill_offers table  
- Added a seeder with 30 sample records, useful for demonstrating pagination, searching, and overall functionality  

### Input Validation

- Used Laravel’s built in validation inside store() and update() 
- Prevents invalid form submissions  
- Ensures clean and safe data  

### Routing with Resource Controllers

Used:

Route::resource(skill_offers, SkillOfferController::class)

This automatically generates CRUD routes, keeping routing clean and following Laravel conventions.

### Pagination & Search

- Pagination implemented using:  

 $skillOffers->paginate(5);

- Search implemented using conditional query filters inside the controller  

### Clean & Consistent Layout

- Shared Blade layout for consistent design  
- Fully custom CSS  
- No external libraries, as required by the assignment  



## 4. Conclusion

The Skill Swap Hub project successfully demonstrates my understanding of:

- MVC architecture  
- Routing  
- Migrations  
- Controllers  
- Eloquent Models  
- Blade Templates  
- Validation  
- Pagination  

The application is easy to navigate, meets all assignment requirements, and follows good development practices.
