
/**
 * Board handler object
 *
 * Renders board to html DOM
 *
 * @type {{render: board.render}}
 */
var board = {
    /**
     * Renders board status to html
     *
     * @param board Board status
     */
    render : function(board) {
        // for each row
        for (var i in board['board']) {
            // for each cell
            for (var j in board['board'][i]) {
                // render cell team game piece
                var cell = document.getElementById('cell-' + i + j);
                cell.innerHTML = board['board'][i][j]['team'];

                // set winner pieces color
                if (board['board'][i][j]['winner']) {
                    cell.className = 'winner-cell';
                }

                // show play again button
                if (board['gameOver']) {
                    this.showPlayAgainButton();
                }
            }
        }
    },

    /**
     * show play again button
     */
    showPlayAgainButton : function() {
        document.getElementById('play-again').style.display = 'block';
    }
};

/**
 * Game handler object
 *
 * @type {{start: game.start}}
 */
var game = {
    /**
     * Initializes board event listeners
     */
    start: function (board, gameType) {
        // foreach row
        for (var x = 0; x < 3; x++) {
            // foreach cell
            for (var y = 0; y < 3; y++) {
                document.getElementById('cell-' + x + y).onclick = (function (x, y) {
                    return function (e) {
                        $.ajax({
                            type: 'PUT',
                            beforeSend: function(request) {
                                request.setRequestHeader('Authorization', authToken);
                            },
                            url: '/api/v1/move',
                            data: 'coordinate_x=' + x + '&coordinate_y=' + y,
                            success: function (data) {
                                if (data['result']) {
                                    board.render(data['data']);

                                    // show play again button
                                    if (data['data']['gameOver']) {
                                        board.showPlayAgainButton();
                                    } else if (gameType == 'one-player') { // bot's turn
                                        game.botTurn();
                                    }
                                } else {
                                    console.log(data['data']['message']);
                                }
                            }
                        });
                    };
                }(x, y));
            }
        }
    },

    /**
     * Call to the API to make bot to play
     */
    botTurn : function() {
        $.ajax({
            type: 'PUT',
            beforeSend: function(request) {
                request.setRequestHeader('Authorization', authToken);
            },
            url: '/api/v1/bot-move',
            success: function (data) {
                if (data['result']) {
                    board.render(data['data']);
                } else {
                    console.log(data['data']['message']);
                }
            }
        });
    }
};

// start game
game.start(board, gameType);
