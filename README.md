# Docler Holding - Tic Tac Assessment
Alejandro Barba Prieto

##Introduction

This is the code repository for Docler Holding - Php Developer Assessment: Tic Tac Toe Game.

Technologies I have used to develop the game are:

- Vagrant. To create portable virtual machines and facilitate development environments.

- Ansible. To provision the development environment and guarantee same server versions for all developers. This way
I'm able to provide either a software and a (virtual) hardware implementation to avoid problems when trying the code.

- Slim 3 Framework. Being that the assessment required to implement an API I choose to use Slim because I have been
reading a bit about how easy and fast is to create APIs with this PSR7 compatible lightweight micro framework and 
I really wanted to try it. So, to make the assessment funnier I decided to try it (and avoid to use a macro framework 
like Symfony or write everything from scratch) so, even if not getting the position, at least I would learn Slim :).

- Monolog. To log messages following a PSR standard.

- Twig. Because it is really easy to implement on Slim and I really like this template engine.

- Less CSS Precompiler. To facilitate making the app responsive.

##Description

Inside the "src" folder there are 3 sub folders:
 
- App. The App namespace represents the framework configuration. Official Slim skeleton defines most of its
dependencies and settings as "side effects" php files (not symbol definition ones) what I don't like so I moved 
these to classes inside this namespace. For example, "SettingsStore" implements the Store pattern and let us override
settings per environment being "development" the base environment. The rest of the classes here are "invokable" files.

- Api. Under this namespace I implemented the game Api. It has two end-points, "move" to require human moves and 
"bot-move" to ask the bot to make a move. Api is versioned under V1 folder, implements OAuth authentication and it has 
integration tests (as it is really lightweight and its unique purpose is to call the Domain under \TicTac).

- TicTac. This is the main namespace which contains the HTML app and the Game domain logic. For the app I used Twig
for the templates, plain Javascript to manage API requests (and jQuery), and Less for the CSS. On the Domain namespace
there are the plain Php classes, interfaces and traits that perform game logic. Game can be played against the bot or
against another person (in turns). The bot implements the "minimax" algorithm to choose always the best move.

##Testing

For the app automatic testing I decided to implement two types of tests:

- Unit tests. To test Domain logic independently. For classes under Domain.
- Integration. To test the whole system working together (Actions and Domain). These tests works for the framework 
routes.

##Execution

To directly play the game just press on: 
https://tictactoe.alexagile.com/ 
(autosigned certs so you need to add a security exception to your browser, sorry)

This is hosted on an fresh Amazon Web Services T2.micro instance.

You can check the Swagger API documentation on: https://tictactoe.alexagile.com/api/v1/doc/
(click on default)

The Continuous Integration of the project is provided by Jenkins Server on:
http://jenkins.alexagile.com/job/TicTac/

User: docler
Passwd: docler

Code coverage can be checked on:
http://jenkins.alexagile.com/job/TicTac/HTML_Coverage/

##Install on local server

If you prefer to deploy and execute the app on your own server you can try the Vagrant-Ansible provision.
 
1. Copy "vagrant_inventory.example.yml" to "vagrant_inventory.yml" and set it up.
2. Review the values on the file "ansible/hosts" to make them agree with the previous file.
3. Execute: vagrant up
4. Ssh the Vagrant with: vagrant ssh
5. Go to "/var/www/local.doclertictac.com" and execute "composer install"
6. Map "local.doclertictac.com" to your Vagrant Ip in your host machine.
7. Urls are: 
    - Game: https://local.doclertictac.com
    - Api doc: https://local.doclertictac.com/api/v1/doc 
    (in the text box write: https://local.doclertictac.com/api/v1/doc.json)
    - Code coverage: https://local.doclertictac.com/coverage/index.html
8. Enjoy
