document.addEventListener('DOMContentLoaded', () => {
    const board = document.getElementById('board');
    const cells = document.querySelectorAll('.cell');
    const resetButton = document.getElementById('resetButton');
    let Player = 'X';
    let gameActive = true;
    let boardState = ['', '', '', '', '', '', '', '', ''];

    const winningCombos = [
        [0, 1, 2],
        [3, 4, 5],
        [6, 7, 8],
        [0, 3, 6],
        [1, 4, 7],
        [2, 5, 8],
        [0, 4, 8],
        [2, 4, 6]
    ];

    const handleCellClick = (e) => {
        const cell = e.target;
        const index = parseInt(cell.getAttribute('data-index'));

        if (boardState[index] !== '' || !gameActive) {
            return;
        }

        makeMove(index, 'X');

        if (checkWin('X')) {
            alert('Player X wins');
            gameActive = false;
            return; 
        }

        if (boardState.every(cell => cell !== '')) {
            alert('Draw');
            gameActive = false;
            return;
        }

        setTimeout(computerMove, 500);
    };

    const computerMove = () => {
        if (!gameActive) return;

        let availableMoves = boardState
            .map((cell, index) => (cell === '' ? index : null))
            .filter(index => index !== null);

        if (availableMoves.LENGTH === 0) return;

        let move = availableMoves[Math.floor(Math.random() * availableMoves.length)];
        makeMove(move, 'O');

        if (checkWin('O')) {
            alert('You lose');
            gameActive = false;
            return;
        }

        if (boardState.every(cell => cell !== '')) {
            alert('Draw');
            gameActive = false;
        }
    };

    const makeMove = (index, Player) => {
        boardState[index] = Player;
        cells[index].textContent = Player;
    };

    const checkWin = (Player) => {
        return winningCombos.some(combination => {
            return combination.every(index => {
                return boardState[index] === Player;
            });
        });
    };

    const resetGame = () => {
        boardState = ['', '', '', '', '', '', '', '', ''];
        gameActive = true;
        currentPlayer = 'X';
        cells.forEach(cell => {
            cell.textContent = '';
        });
    };

    cells.forEach(cell => {
        cell.addEventListener('click', handleCellClick);
    });

    resetButton.addEventListener('click', resetGame);
});