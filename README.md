# Holy Quran

A Laravel web application contains the complete Quran with a simple recitation script and time segmenting for every verse

Please use this tool wherever you want, but please don't forget to credit this repository.


![App Preview](https://raw.githubusercontent.com/xTrimy/holy-quran/master/img/app-preview.png)

![App Preview 2](https://raw.githubusercontent.com/xTrimy/holy-quran/master/img/app-preview-2.png)

## Contribution

If you'd like to contribute to the project, please fork, fix, commit and send a pull request to be reviewed and merged into the main code base. If you wish to submit more complex changes though, please consider contacting me first to ensure those changes are in line with the general philosophy of the project and/or get some early feedback which can make both your efforts much lighter as well as my review and merge procedures quick and simple.

Please make sure your contributions adhere to those guidelines:

- Code must adhere to the official formatting guidelines.
- Code must be well documented (Code comments).
- Pull requests need to be based on and opened against the `master` branch.

## Usage

To be able to run this project please follow the following instructions:\
Clone the project.\
Navigate to the project's folder

- Install composer
- Install node.js
- Run `composer install`
- Run `npm install`
- Copy `.env.example` to `.env`
- Run `php artisan key:generate`
- Run `php artisan migrate`
- Import the database provided: `quran.sql` into `holyquraan` mysql database
- Download [Abdulbasit Abdulsamad - Mujawwad Recitation](https://tvquran.com/en/collection/2) and add all the sound files to `public/Quran/Abdul_Bassit_Mujawwad
- Run `php artisan serve`

## NOTICES

This project uses timing files for current verse highlighting while listening to the recitation.\
These timing files are by <https://everyayah.com/>

## Contact

- [Facebook](https://www.facebook.com/Mhmd.Ashf/)
- Email - Mohamed.ashraf881999@gmail.com
- Twitter - [@MohamedAsh8](https://twitter.com/MohamedAsh8)
