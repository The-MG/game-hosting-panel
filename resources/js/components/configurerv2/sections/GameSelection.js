import React, {useEffect} from 'react';
import {useDispatch} from "react-redux";
import useGames from "../hooks/useGames";
import Game from "./../sections/partials/Game";
import Card from "../ui/Card";

export default function GameSelection({selected, onSelect}) {
    const dispatch = useDispatch();
    const games = useGames();

    useEffect(() => {
        dispatch.games.load();
    }, []);

    function handleOnClick(id) {
        onSelect && onSelect(selected === id ? null : id);
    }

    return <Card
        title="Game"
        subtitle="Which game do you want to host"
        loading={games.loading}
        cols={5}
    >
        {
            Object
                .entries(games.games)
                .filter(([_, game]) => game.cover)
                .map(([id, game]) => (
                    <Game
                        key={id}
                        id={id}
                        game={game}
                        selected={selected ? id === selected : null}
                        onClick={handleOnClick}
                    />
                ))
        }
    </Card>
}
