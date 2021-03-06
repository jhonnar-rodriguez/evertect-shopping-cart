# Shopping Cart Client

Basic store where a customer can buy items.

## Server Requirements

Make sure your server meets the following requirements:

- [GIT](https://git-scm.com/)
- [NodeJS](https://nodejs.org/es/)

## Installation
- Clone the project

    ```git clone https://github.com/jhonnar-rodriguez/evertec-shopping-cart.git```

- Move to the project folder

    ```cd evertec-shopping-cart-client```
 
- Copy .env.example and rename it to .env

    ```cp .env.example .env```

- Setup your credentials in the .env file. The following variables are mandatory:
    * REACT_APP_CLIENT_URL: Frontend running url. Example: http://localhost:3000
    * REACT_APP_BACKEND_URL: Backend running url. Example: http://localhost:5000/shopping-cart-api/public
 
- Install Dependencies

    ```npm install```

## Available Scripts

In the project directory, you can run:

```npm start```

Runs the app in the development mode.<br />
Open [http://localhost:3000](http://localhost:3000) to view it in the browser.

The page will reload if you make edits.<br />
You will also see any lint errors in the console.

```npm run lint```

Run the coding style validations and if it fails a list of files and it's problems.

```npm run lint:fix```

Will try to fix all files with errors

## Built With

- [Create React App](https://create-react-app.dev/docs/getting-started/) - Bootstrapped with Create React App
- [React](https://es.reactjs.org/) - JavaScript library for building user interfaces.
- [Npm](https://www.npmjs.com/) - Package Manager and Installer

## Notes
- If you want the realtime linting while your are writing code on Visual Studio Code you need to install the ESLint extension

## Features
- Login
- Logout
- Product List
- Add Product To Cart - With|Without Login
- Place Order
- Communication with PlaceToPay to generate an order
- Orders List
- Re order: A new cart will be created with the same items as the selected order (Previous confirmation)

## In Progress
- Redirection page after the completed payment process to catch the transaction status.

## Enjoy!!