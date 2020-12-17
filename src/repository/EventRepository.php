<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class EventRepository extends Repository
{
    public function getProject(int $id): ?Event{
        //getting user from database
        $statement = $this->prepareStatement('SELECT * FROM public.events where id = :id;');
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $event = $statement->fetch(PDO::FETCH_ASSOC);

        //getting event details from database
        $statement = $this->prepareStatement('SELECT * FROM public.event_details where id = :id;');
        $statement->bindParam(':id', $event['event_details_id'], PDO::PARAM_INT);
        $statement->execute();
        $eventDetails = $statement->fetch();

        //getting sport name from database
        $statement = $this->prepareStatement('SELECT * FROM public.sports where id = :id;');
        $statement->bindParam(':id', $event['sport_id'], PDO::PARAM_INT);
        $statement->execute();
        $sport = $statement->fetch();

        return new Event(
            $eventDetails['title'],
            $eventDetails['description'],
            $sport['name'],
            $eventDetails['number_of_players'],
            $eventDetails['location'],
            $eventDetails['date'],
            $eventDetails['image']
        );
    }
    public function addEvent(Event $event): void{
        $eventDetails = [
            $event->getTitle(),
            $event->getDescription(),
            $event->getNumberOfPlayers(),
            $event->getDate(),
            $event->getLocation(),
            $event->getImage()
        ];
        $statement = $this->prepareStatement('INSERT INTO event_details VALUES(DEFAULT , ?, ?, ?, ?, ?, ?)');
        $statement->execute($eventDetails);

        $statement = $this->prepareStatement('SELECT id FROM event_details WHERE title=?');
        $statement->execute([$eventDetails[0]]);
        $id = $statement->fetch()['id'];

        $statement = $this->prepareStatement('SELECT id FROM sports WHERE name=?');
        $statement->execute([$event->getSport()]);
        $sportId = $statement->fetch()['id'];

        $statement = $this->prepareStatement('INSERT INTO events VALUES (DEFAULT, 1,?, ?, DEFAULT)');
        $statement->execute([$sportId, $id]);

    }
    public function getEvents(): array{

        $results = [];
        $statement = $this->prepareStatement('SELECT id FROM events;');
        $statement->execute();

        $events = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($events as $event){
            $results[] = $this->getProject($event['id']);
        }
        return $results;
    }
}