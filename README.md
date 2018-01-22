# About

Sample OctoberCMS plugin to demonstrate creating CRUD features for existing backend models/controllers within the frontend.

>**NOTE:** This plugin is NOT production ready. Additional security checks and verification steps MUST be added before implementing on a production site.

## Demo
![CRUD demo](https://user-images.githubusercontent.com/12028540/27440023-be556244-5769-11e7-8d04-1540b822d66c.gif)

## Usage
This plugin demonstrates the following three components:

### crudList
Displays a list of items and adds ability to delete items when clicking on the delete button.

Property | Description | Example
--- | :--- | ---
Model | The full class name of the model you want to use (with namespace) | `\Dev\Plugin\Models\User`
Field to display | The name of the property you want to display in the list | `title`
Page Edit Item | The page that contains the crudUpdate component (used by the Edit buttons) | `update.htm`
Page New Item | The page that contain the crudCreate component (used by the New item button) | `create.htm`

### crudUpdate
Displays an edit form.

Property | Description | Example
--- | :--- | ---
Model | The full class name of the model you want to use (with namespace) | `Dev\Plugin\Models\User`
Controller | The full class name of the controller you want to use (with namespace) | `Dev\Plugin\Controllers\Users`
Form context | The context you want to use (see [Backend forms > Field options > Context](https://octobercms.com/docs/backend/forms#form-field-options)) | `frontend`
ID | The primary key of the item you want to edit (can be a URL parameter) | `{{ :id }}`
Form config (optional) | Override the default form configuration file (`fields.yaml`) defined in the controller (`config_form.yaml`) (see [Backend forms > Defining form fields](https://octobercms.com/docs/backend/forms#form-fields) | `$/dev/plugin/models/user/fields.yaml`
Success page | The Page to redirect the user after model has correctly saved | `update.htm`

### crudCreate
Displays a create form

Property | Description | Example
--- | :--- | ---
Model | The full class name of the model you want to use (with namespace) | `Dev\Plugin\Models\User`
Controller | The full class name of the controller you want to use (with namespace) | `Dev\Plugin\Controllers\Users`
Form context | The context you want to use (see [Backend forms > Field options > Context](https://octobercms.com/docs/backend/forms#form-field-options)) | `frontend`
ID | Primary key of the item you want edit
Form config (optional) | Override the default form configuration file (`fields.yaml`) defined in the controller (`config_form.yaml`) (see [Backend forms > Defining form fields](https://octobercms.com/docs/backend/forms#form-fields) | `$/dev/plugin/models/user/fields.yaml`
Success page | The Page to redirect the user after model has correctly saved | `update.htm`

## Current Limitations
- Backend widget are not supported (the DOM is generated but without any JS/CSS) - Any PRs are welcome
- No access validation, anybody with access to the routes that these components live on can update your models without authorization or validation.

## Author
inetis is a webdesign agency in Vufflens-la-Ville, Switzerland. We love coding and creating powerful apps and sites  [see our website](https://inetis.ch).
