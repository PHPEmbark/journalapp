<?php
namespace Journal\Model;
use Journal\Db;

class Entries {

    protected $db = null;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function insert(Entry $entry)
    {
        $sql =
            'INSERT INTO entry (
                user_id,
                title,
                article
            ) VALUES (
                :user_id,
                :title,
                :article
            )';

        $bind = [
            ':user_id' => $entry->user_id,
            ':title' => $entry->title,
            ':article' => $entry->article,
        ];

        $query = $this->db->prepare($sql);
        $status = $query->execute($bind);

        $entry->entry_id = $this->db->lastInsertId();

        return $status;
    }

    public function update(Entry $entry)
    {
        $sql =
            'UPDATE entry
                SET
                    user_id = :user_id,
                    title = :title,
                    article = :article
                WHERE
                    entry_id = :entry_id';

        $bind = [
            ':user_id' => $entry->user_id,
            ':title' => $entry->title,
            ':article' => $entry->article,
            ':entry_id' => $entry->entry_id,
        ];

        $query = $this->db->prepare($sql);
        return $query->execute($bind);
    }

    public function delete($id)
    {
        $sql =
            'DELETE FROM entry
                WHERE
                    entry_id = :entry_id';

        $bind = [
            ':entry_id' => $id,
        ];

        $query = $this->db->prepare($sql);
        return $query->execute($bind);
    }

    public function getEntry($id)
    {
        $sql =
            'SELECT entry.entry_id,
                    entry.user_id,
                    entry.title,
                    entry.article,
                    user.display AS name
                FROM entry
                    INNER JOIN user ON (user.user_id=entry.user_id)
                WHERE entry_id = :entry_id LIMIT 1';

        $bind = [
            ':entry_id' => $id,
        ];

        $query = $this->db->prepare($sql);
        $status = $query->execute($bind);

        if(! $status) {
            return false;
        }

        return $query->fetchObject('Journal\Model\Entry');
    }

    public function getAllEntries()
    {
        $sql =
            'SELECT entry.entry_id,
                    entry.user_id,
                    entry.title,
                    entry.article,
                    user.display AS name
                FROM entry
                    INNER JOIN user ON (user.user_id=entry.user_id)
                ORDER BY entry.entry_id DESC, entry.title ASC';

        $query = $this->db->prepare($sql);
        $status = $query->execute();

        if(! $status) {
            return false;
        }

        $query->setFetchMode(Db::FETCH_CLASS, 'Journal\Model\Entry');

        return $query;
    }
}