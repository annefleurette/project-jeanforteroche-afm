
SELECT jeux_video.nom, proprietaires.prenom
FROM proprietaires, jeux_video
WHERE jeux_video.ID_proprietaire = proprietaires.ID


SELECT m.pseudo pseudo_members, c.comment comment_comments, c.id id_comments
FROM members AS, comments c
WHERE m.id = c.id_pseudo