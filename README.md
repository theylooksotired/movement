# Movement

This is a simple movement simulation of a token in a board.
It will be coded on PHP using the Symfony framework, because it's the one I'm most used, but the logic is very easy to translate to any other language or framework.

# First proof of concept

The idea of this POC is to understand the algorithm and to see it running. So let's strip down everything (architecture, classes, objects) and focus on a simple input/output.

We already decided that the borad is a matrix where every point is valid. A token has a position (x,y) and a direction.

Then we strip down the input to create the board and the token, and finally we run the commands according to what we established in the personal notes.

For the moment the proof of concept seems to work because it does what was written on paper.

```
php bin/console simulate 4,4,2,2,1,4,1,3,2,3,2,4,1,0
^ "--1--"
^ array:3 [
  "col" => 2
  "row" => 1
  "direction" => "N"
]
^ "--4--"
^ array:3 [
  "col" => 2
  "row" => 1
  "direction" => "W"
]
^ "--1--"
^ array:3 [
  "col" => 1
  "row" => 1
  "direction" => "W"
]
^ "--3--"
^ array:3 [
  "col" => 1
  "row" => 1
  "direction" => "N"
]
^ "--2--"
^ array:3 [
  "col" => 1
  "row" => 2
  "direction" => "N"
]
^ "--3--"
^ array:3 [
  "col" => 1
  "row" => 2
  "direction" => "E"
]
^ "--2--"
^ array:3 [
  "col" => 0
  "row" => 2
  "direction" => "E"
]
^ "--4--"
^ array:3 [
  "col" => 0
  "row" => 2
  "direction" => "N"
]
^ "--1--"
^ array:3 [
  "col" => 0
  "row" => 1
  "direction" => "N"
]
^ "--0--"
1^ "--END--"
2^ array:3 [
  "col" => 0
  "row" => 1
  "direction" => "N"
]
```

## Personal notes

This notes explain how it works, but let's wait for the next commits to get something better.

![Personal notes](https://test.leanomartinet.com/ressources/movement_sketch1.jpeg)
![Personal notes](https://test.leanomartinet.com/ressources/movement_sketch2.jpeg)
