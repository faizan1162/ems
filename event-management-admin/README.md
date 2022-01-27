## Vue3 Frontend Admin panel: Folder Name: event-management-admin


- npm install gloabally.
- vue cli installed globally
- run the npm install on root of this folder


## NPM Install Globally

If node js is not installed globally please install it from the official documentation
https://docs.npmjs.com/downloading-and-installing-node-js-and-npm



## Vue Cli Install Globally

Node Version Requirement

Vue CLI 4.x requires Node.js version 8.9 or above (v10+ recommended). You can manage multiple versions of Node on the same machine with n, nvm or nvm-windows.

To install the new package, use one of the following commands. You need administrator privileges to execute these unless npm was installed on your system through a Node.js version manager (e.g. n or nvm).

npm install -g @vue/cli
# OR
yarn global add @vue/cli


### Change URL if required

- If your laravel server not run on this url: >> http://127.0.0.1:8000  
- than you need to update the some url  go to below directory anf open constants.js file 
- event-management-admin/src/config/constants.js file and update some url:

- export const API_URL = "http://127.0.0.1:8000/api/v1/";
- export const IMAGE_URL = "http://127.0.0.1:8000/assets/uploads/images/";
- export const THUMB_URL = "http://127.0.0.1:8000/assets/thumbnails/";

### Run this command for node_module installation
In your root foler open cmd prompt and run this command
npm install --save

### Run project
After Succesfull setup all things run the development server for vue js run below command.

npm run serve

After development server started open this url : http://localhost:8080/