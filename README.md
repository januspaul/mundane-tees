# Mini-Project

This mini project serves as a higher level training module for new the members. The intentions of this module is to apply the knowledge, principle, and fundamentals learned from the previous training by creating a website from scratch.

## Requirements

- XAMPP Stack (Apache, MySQL)
- Git

## Installation

Clone this repository to your work directory by entering this command:

```bash
git clone this-repos-git-url
```

After cloning the repository, create a database and name it as catalogue. We'll be leaving the name and structure of tables to you.

## Instructions

Create a T-shirt masterlist website with the following features:

### Login

- Only authenticated users can view/edit the T-shirt.
- There are unlimited users, each classified as either admin, editor, or viewer.
- Viewer types of users cannot edit the products
- Admin Accounts has all the priveleges including account manpulation, role designation, and entry visibility.
- Editor Accounts can only add an entry and edit an entry.

### Attributes

Each T-Shirt has the following attributes:

- Size: xxs, xs, s, m, l, xl, xxl, xxxl
- Sleeve
- Style
- Neck Shape
- Sex: M/F/Unisex
- Name: Open Text
- Item Code: System-generated code that will be unique per item. Define a fixed-length item code convention that gives people a basic idea of the t-shirt from reading it. Be sure to add incremental number component to handle t-shirts that will have the same attributes
- Image

### Tags

Aside from the attributes of the t-shirt, each shirt can have "tags". The tags are optional, but can be as many as the needed.

- Create a master list of tags
- Example tags are: Summer, Celebrity, Limited edition, etc

### Search

Allow users to search by attribute and limit search further using tags (ideally user can add multiple tags, but just use one or none as a start)

- Display the images of the results in grid format
- Be sure to handle t-shirts that don't have images
- Search results will give only 5 items at a time, click "more" will show the next batch until no more items found.

### Look

 You are free to design the look as long as the specifications are met. Responsive Design is preferred.

## Reminders

A few reminders for working on this project.

- Once this repository has been set up to your local machine, please keep in mind to make a branch for every implementation or fixes. This is to make your changes organized and isolated from the other files.
- Do not make any changes to the `main` branch. Create a branch for your own version of this project, this will serve as your main branch.
- Always create a pull request for every branch (except for your main branch). This will help you review, your code before merging it to your main branch.
- Keep everything updated, always pull from your main branch after a merge. It prevents unwanted code conflicts.
- Keep your indentions exactly 2 spaces.
- Any database structure changes should also be committed.
- Organize your files based on their purpose and type.
- Use `JSON`, `fetch API` for the Login and Search Pages. For these pages, your Php scripts should only generate JSON data that will be processed for display at the client side.
- Prepare a development plan presentation for this project. You cannot proceed without presenting your plans first.

## Concerns

If you have concerns please do not hesitate to approach us. Best of luck!
#mundane-tees
