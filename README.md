# Holy Quran

A Laravel web application contains the complete Quran with a simple recitation script and time segmenting for every verse

Please use this tool wherever you want, but please don't forget to credit this repository.


![App Preview](https://raw.githubusercontent.com/xTrimy/holy-quran/master/img/app-preview.png)

![App Preview 2](https://raw.githubusercontent.com/xTrimy/holy-quran/master/img/app-preview-2.png)

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
- Download [Nasser Al Qatami Recitation](https://www.tvquran.com/en/scholar/90/profile/nasser-alqatami) and add all the sound files to `public/Quran/Nasser-Al-Qatami
- Run `php artisan serve`

## NOTICES

This project uses timing files for current verse highlighting while listening to the recitation.\
These timing files are by <https://everyayah.com/>

## Contribution

If you'd like to contribute to the project, please fork, fix, commit and send a pull request to be reviewed and merged into the main code base. If you wish to submit more complex changes though, please consider contacting me first to ensure those changes are in line with the general philosophy of the project and/or get some early feedback which can make both your efforts much lighter as well as my review and merge procedures quick and simple.

Please make sure your contributions adhere to those guidelines:

- Code must adhere to the official formatting guidelines.
- Code must be well documented (Code comments).
- Pull requests need to be based on and opened against the `master` branch.

### Recitations

If you want to contribute by adding more reciters, please follow these instructions:

The recitation files are provided by <https://www.tvquran.com/>, but please note that if you want to add highlights for the current verse, it's better to follow the links provided by <https://everyayah.com/> on the details.txt file found with the timing files.\
Recitation files should be added to the `public/Quran/<reciter>` folder.

For making it easier for you to use the timing files, I have created a script that will automatically convert all the timing files for a single reciter to a single `.json` file.\
This script can be found in the `segmentation_helper` folder.\
This `.json` file can be then converted to mysql more easily.

## Contact

- [Facebook](https://www.facebook.com/Mhmd.Ashf/)
- Email - Mohamed.ashraf881999@gmail.com
- Twitter - [@MohamedAsh8](https://twitter.com/MohamedAsh8)
