# Movement

This is a simple movement simulation of a token in a board.

It is be coded on PHP using the *Symfony* framework, because it's the one I'm most used, but the logic is very easy to translate to any other language or framework.

To test it: https://movement.leanomartinet.com/

# Running the simulation

For the purpose of testing, the simulation will be run with a command, for example:

```
php bin/console simulate 4,4,2,2,1,4,1,3,2,3,2,4,1
```

To use the standard input (stdin), we can run as follows:

```
echo "4,4,2,2,1,4,1,3,2,3,2,4,1" | php bin/console simulate
```

In both cases we get the same response:

```
0,1
```

# The architecture

This is a very simple program for something like *Symfony*, but still I wanted to showcase some of the features.

*Symfony* is more structured to deal with objects that should be persisted, it's connection using doctrine makes it very powerful. But it's also sold as a tool that can run microservices and this is one of it.

## Simulate as a service

Following the philosophy of *Symfony*, the Simulation should run as a service, this one creates a board, a token and runs the commands.

Certains assumptions are made:

- The input can be separated by either commas or espaces, for example these will give the same output:
```
4,4,2,2,1,3,2,0
4 4 2 2 1 3 2 0
4,4,2, 2 , 1,3, 2,0
```

- Any other command that is not (0,1,2,3,4) will be just ignored, the board and token will remain the same position


## Board as an interface

One of the extras of the exercise is that we have to get ready for new types of boards.

For this exercise I made the assumption that any shape can be drawn inside a rectangle. Let's says that the shape is defined by the "true" cells, and the other ones that don't make the shape are the "false" cells.

The interface defines a couple of functions, the **getBoard** which actually draws the board and the **isPositionValid** that tells us if a certain cell is true or false.

This simulation has only a single implementation of this interface, which is a rectangular board in the class **BoardRectangle**. The **isPositionValid** only returns false when the token gets completely out of the board.

## A simple token

The token is a simple object that has a position (row and column) and a direction where it's pointing. This direction is very important to perform the commands, since all of them depend on it.

## Movement

I decided that every movement should be defined as an abstraction, hence the abstract class **AbstractMovement**.

A movement has a token and a board and has to move both of them, obviously we can decide not to move by just passing the object, but the functions **moveToken** and **moveBoard** must exist for every implementation of this class.

### Movement implementations

There are four implementations of each movement:

- **Forward**, meaning that the token will advance one cell.
- **Backward**, meaning that the token will go back one cell.
- **Clockwise**, meaning that the token will change its direction 90 degree clockwise.
- **Clockwise Reverse**, meaning that the token will change its direction 90 degree anti-clockwise.

The board remains untouched in all of these movements.

# Testing

I have implement php/unit which is the default testing solution in Symfony and run the necessary tests for the application, meaning tests of:

- The original one of the exercise
- Just sending the headers with any movements (should return the position of the token if valid)
- Sending invalid commands, like letters
- Valid movements (forward, backward, rotation)

In PHP we can use xDebug for code coverage but I didn't really understood what was meant by the "explain any coverage gaps" phrase.

# HTML Platform

There's a very simple HTML page to test the simulation, it has a textarea that gets the commands and executes them line by line.

![Online simulation](https://test.leanomartinet.com/ressources/movement_html.png)


---
---
---

# Personal notes

This notes explain how it works, but let's wait for the next commits to get something better.

![Personal notes](https://test.leanomartinet.com/ressources/movement_sketch1.jpeg)
![Personal notes](https://test.leanomartinet.com/ressources/movement_sketch2.jpeg)