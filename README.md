# Frontend CRUD plugin 
The idea of this plugin is to easily create CRUD features for existing backend model controller.

> This plugin is not ready for production. You need to add more security checks before implement it on your site.

## Demo
![CRUD demo](https://user-images.githubusercontent.com/12028540/27440023-be556244-5769-11e7-8d04-1540b822d66c.gif)

## Usage
This plugin work with 3 component : 

### List
Display the list of items and delete items when click on delete button.

Property | Description
--- | :---
Model | The full name of the model you want use (with namespace) eg:&nbsp;`Dev\Plugin\Models\User`
Field to display | Name of the field you want display in the list eg:&nbsp;title  
Page Edit Item | The page that contain the Update component (used by edit buttons)
Page New Item | The page that contain the Create component (used by New item button)

### Update
Display an edit form

Property | Description | Example
--- | :--- | ---
Model | The full name of the model you want use (with namespace) | `Dev\Plugin\Models\User`
Controller | The full name of your the controller you want use (with namespace) | `Dev\Plugin\Controllers\Users`
Form context | You can choose the context you want use (see [Backend forms > Field options > Context](https://octobercms.com/docs/backend/forms#form-field-options)) | frontend
ID | Primary key of the item you want edit
Form config (optional) | Override the default model configuration file (`fields.yaml`) defined in the controller (`config_form.yaml`) (see [Backend forms > Defining form fields](https://octobercms.com/docs/backend/forms#form-fields) | `$/dev/plugin/models/user/fields.yaml`
Success page | Page to redirect user after model correctly saved

### Create
Display a create form

Property | Description | Example
--- | :--- | ---
Model | The full name of the model you want use (with namespace) | `Dev\Plugin\Models\User`
Controller | The full name of your the controller you want use (with namespace) | `Dev\Plugin\Controllers\Users`
Form context | You can choose the context you want use (see [Backend forms > Field options > Context](https://octobercms.com/docs/backend/forms#form-field-options)) | frontend
ID | Primary key of the item you want edit
Form config (optional) | Override the default model configuration file (`fields.yaml`) defined in the controller (`config_form.yaml`) (see [Backend forms > Defining form fields](https://octobercms.com/docs/backend/forms#form-fields) | `$/dev/plugin/models/user/fields.yaml`
Success page | Page to redirect user after model correctly saved

## Limitations
- Backend widget are not supported (DOM is generated but without any JS/CSS) - PR are welcome
- No access rules, everybody can update your models

## Author
inetis is a webdesign agency in Vufflens-la-Ville, Switzerland. We love coding and creating powerful apps and sites  [see our website](https://inetis.ch).
