# bootscreen3ds
Old School BIOS Generator for MenuHax Nintendo 3DS

## How do I use this?

1. Load the [website](https://sebascontre.github.io/bootscreen3ds/).

2. Use the options to tweak the screen to your liking.

3. Download the BIN file of your screen.

4. Put the BIN file in the correct spot on the SD Card.

##### I use Luma3DS and the splash doesn't work! How do I fix that?

1. Make sure the .bin file is named splash.bin and is put in SD:/Luma

2. Hold select on boot to access Luma settings

3. Make sure the splash option is set to *before* or *after*

4. Press start to save and reboot.

5. Enjoy your splash!


## Changelog

**Version 5.1.2**

* Replace ``Energy Luma Logo`` check with a selector.
* Add ``Luma Icon`` option and ``No Logo`` option` to logo selector.

**Version 5.1.1**

* Add ``Extra Options`` panel
* Add ``Energy Luma Logo`` option.

**Version 5.1**

* Add buttons to download PNG image and BIN file.
* BIN files are now generated in the same page, don't need to carry over other tool.

**Version 5.0.4**

* Further improvements to overall system stability and other minor adjustments have been made to enhance the user experience.

**Version 5.0.3**

* Fix error with the Internal Memory selector, now changes with the 3DS Model.
* Add ``Luma3DS hourly`` option to type selector.

**Version 5.0.2**

* Fix typo with XL models in JPN region. The models are ``LL`` instead of ``XL``.

**Version 5.0.1**

* Fix typo from ``Copyrigth`` to ``Copyright``
* Add ``200GB`` and ``256GB`` options to SD Card Selector

**Version 5.0**

* Rewrite all the code from PHP-version to Javascript.
* Use real font with canvas instead of premade png images.