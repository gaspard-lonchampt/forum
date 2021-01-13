<?php

class Messages{
    private $id;
    public $id_topic;
    public $id_posteur;
    public $date_heure_post;
    public $message;
    public $id_like;
    public $id_visibilite;

    public function __construct($id_topic, $id_posteur, $date_heure_post, $message, $id_like, $id_visibilite)
    {
        $this->id_topic = $id_topic ;
        $this->id_posteur = $id_posteur ;
        $this->date_heure_post = $date_heure_post;
        $this->message = $message ; 
        $this->id_like = $id_like ; 
        $this->id_visibilite ; 
        $this->bdd = $this->db_connexion(); 

    }

    public function db_connexion() {
        try {
            $bdd = new PDO("mysql:host=localhost;dbname=forum", 'root', '');
            $bdd -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $bdd;
        }
        
        catch (PDOException $e) {
            echo 'Echec de la connexion : ' . $e->getMessage();
        }
    }

    public function create_message()
    {
        if(isset($_POST['message_valider']))
        {
            $message = htmlspecialchars($_POST['message']) ; 
            date_default_timezone_set('Europe/Paris');
            $date = date("Y-m-d H:i:s");
            
            $sql = $this->bdd->prepare("SELECT id_visibilite FROM conversations WHERE id = :id 
            ") ; // on recup l'id_visiblite de la conv qui dépend du get 
    
            $sql->bindParam(':id', $_GET['id']) ;
            $sql->execute() ; 
    
            $result = $sql->fetch(); 
            echo $_GET['id'] ; 

            var_dump($result) ;
    
            $requete = $this->bdd->prepare("INSERT INTO messages (id_conversations, id_topic, id_posteur, date_heure_post, message, id_visibilite)
                                                        VALUES (:id_conversations, :id_topic, :id_posteur, :date_heure_post, :message, :id_visibilite)
            ") ;
    
            $requete->bindParam(':id_conversations', $_GET['id']) ; 
            $requete->bindParam(':id_topic', $_GET['id']) ; 
            $requete->bindParam(':id_posteur', $_SESSION['user']['id']) ; 
            $requete->bindParam(':date_heure_post', $date) ;
            $requete->bindParam(':message',$message) ;
            $requete->bindParam(':id_visibilite',$result['id_visibilite']) ;
    
            $requete->execute(); 
            
        }

    }

    public function afficheMessagesPublic()
    {
        $requete = $this->bdd->prepare("SELECT message,date_heure_post,login 
                                                FROM messages 
                                                    INNER JOIN utilisateurs
                                                        ON messages.id_posteur = utilisateurs.id 
                                                            INNER JOIN conversations 
                                                                    ON conversations.id = messages.id_conversations
                                                                        WHERE conversations.id = :id
                                                                                AND messages.id_visibilite = 0
                                                                                    ORDER BY date_heure_post DESC
        ");
        
        $requete->bindParam(':id', $_GET['id']) ;
        $requete->execute(); 

        $result = $requete->fetchAll();

        foreach($result as $key => $value)
        {
            ?>
            <div class="container d-block p-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">

                            <div class="card-header">
                                <div class="media flex-wrap w-100 align-items-center"> <img src="../img/fuck-cat.jpg" class="d-block ui-w-40 rounded-circle" alt="">
                                    <div class="media-body ml-3"> <a href=""><?= $value['login'] ; ?></a>
                                        <div class="text-muted small">Il y a 12 jours (insérer en php)</div>
                                    </div>
                                    <div class="text-muted small ml-3">
                                        <div>Membre depuis <strong> <?= $value['date_heure_post'] ; ?> </strong></div>
                                        <div><strong>200 (nombre à insérer en php)</strong> de post</div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <p> <?= $value['message'] ; ?> </p>
                                
                            </div>
                            <div class="card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3">
                                <div class="px-4 pt-3"> <a href="" class="text-muted d-inline-flex align-items-center align-middle" data-abc="true"> <i class="fa fa-heart text-danger"></i>&nbsp; <span class="align-middle">445</span> </a> <span class="text-muted d-inline-flex align-items-center align-middle ml-4"> <i class="fa fa-eye text-muted fsize-3"></i>&nbsp; <span class="align-middle">14532</span> </span> </div>
                                <div class="px-4 pt-3"> <button type="button" class="btn btn-primary"><i class="ion ion-md-create"></i>&nbsp; Répondre</button> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php
        }
        
        include ('../include/pages/message_form.php');

    }

    public function afficheMessagesConnect()
    {
        $requete = $this->bdd->prepare("SELECT message,date_heure_post,login 
                                                FROM messages 
                                                    INNER JOIN utilisateurs
                                                        ON messages.id_posteur = utilisateurs.id 
                                                            INNER JOIN conversations 
                                                                    ON conversations.id = messages.id_conversations
                                                                        WHERE conversations.id = :id
                                                                                AND messages.id_visibilite <= 1
                                                                                    ORDER BY date_heure_post DESC
        ");

        $requete->execute(); 

        $result = $requete->fetchAll();

        foreach($result as $key => $value)
        {
            ?>
            <div class="container d-block p-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">

                            <div class="card-header">
                                <div class="media flex-wrap w-100 align-items-center"> <img src="../img/fuck-cat.jpg" class="d-block ui-w-40 rounded-circle" alt="">
                                    <div class="media-body ml-3"> <a href=""><?php echo $value['login'] ; ?></a>
                                        <div class="text-muted small">Il y a 12 jours (insérer en php)</div>
                                    </div>
                                    <div class="text-muted small ml-3">
                                        <div>Membre depuis <strong> <?= $value['date_heure_post'] ; ?> </strong></div>
                                        <div><strong>200 (nombre à insérer en php)</strong> de post</div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <p> <?php echo $value['message'] ; ?> </p>
                                
                            </div>
                            <div class="card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3">
                                <div class="px-4 pt-3"> <a href="" class="text-muted d-inline-flex align-items-center align-middle" data-abc="true"> <i class="fa fa-heart text-danger"></i>&nbsp; <span class="align-middle">445</span> </a> <span class="text-muted d-inline-flex align-items-center align-middle ml-4"> <i class="fa fa-eye text-muted fsize-3"></i>&nbsp; <span class="align-middle">14532</span> </span> </div>
                                <div class="px-4 pt-3"> <button type="button" class="btn btn-primary"><i class="ion ion-md-create"></i>&nbsp; Répondre</button> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php
        }
        
        include ('../include/pages/message_form.php');
    }

    public function afficheMessagesModo()
    {
        $requete = $this->bdd->prepare("SELECT message,date_heure_post,login 
                                                FROM messages 
                                                    INNER JOIN utilisateurs
                                                        ON messages.id_posteur = utilisateurs.id 
                                                            INNER JOIN conversations 
                                                                    ON conversations.id = messages.id_conversations
                                                                        WHERE conversations.id = :id
                                                                                AND messages.id_visibilite <= 2
                                                                                    ORDER BY date_heure_post DESC
        ");

        $requete->bindParam(':id', $_GET['id']) ; 
        $requete->execute(); 

        $result = $requete->fetchAll();

        foreach($result as $key => $value)
        {
            ?>
            <div class="container d-block p-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">

                            <div class="card-header">
                                <div class="media flex-wrap w-100 align-items-center"> <img src="../img/fuck-cat.jpg" class="d-block ui-w-40 rounded-circle" alt="">
                                    <div class="media-body ml-3"> <a href=""><?php echo $value['login'] ; ?></a>
                                        <div class="text-muted small">Il y a 12 jours (insérer en php)</div>
                                    </div>
                                    <div class="text-muted small ml-3">
                                        <div>Membre depuis <strong> <?= $value['date_heure_post'] ; ?> </strong></div>
                                        <div><strong>200 (nombre à insérer en php)</strong> de post</div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <p> <?php echo $value['message'] ; ?> </p>
                                
                            </div>
                            <div class="card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3">
                                <div class="px-4 pt-3"> <a href="" class="text-muted d-inline-flex align-items-center align-middle" data-abc="true"> <i class="fa fa-heart text-danger"></i>&nbsp; <span class="align-middle">445</span> </a> <span class="text-muted d-inline-flex align-items-center align-middle ml-4"> <i class="fa fa-eye text-muted fsize-3"></i>&nbsp; <span class="align-middle">14532</span> </span> </div>
                                <div class="px-4 pt-3"> <button type="button" class="btn btn-primary"><i class="ion ion-md-create"></i>&nbsp; Répondre</button> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php
        }
        
        include ('../include/pages/message_form.php');

        
    }

    public function afficheMessagesAdmin()
    {
        $requete = $this->bdd->prepare("SELECT message,date_heure_post,login 
                                                FROM messages 
                                                    INNER JOIN utilisateurs
                                                        ON messages.id_posteur = utilisateurs.id 
                                                            INNER JOIN conversations 
                                                                    ON conversations.id = messages.id_conversations
                                                                        WHERE conversations.id = :id
                                                                                AND messages.id_visibilite <= 3
                                                                                    ORDER BY date_heure_post DESC
        ");
      
        $requete->bindParam(':id', $_GET['id']) ; 
        $requete->execute(); 

        $result = $requete->fetchAll();

        foreach($result as $key => $value)
        {
            ?>
            <div class="container d-block p-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">

                            <div class="card-header">
                                <div class="media flex-wrap w-100 align-items-center"> <img src="../img/fuck-cat.jpg" class="d-block ui-w-40 rounded-circle" alt="">
                                    <div class="media-body ml-3"> <a href=""><?php echo $value['login'] ; ?></a>
                                        <div class="text-muted small">Il y a 12 jours (insérer en php)</div>
                                    </div>
                                    <div class="text-muted small ml-3">
                                        <div>Membre depuis <strong> <?= $value['date_heure_post'] ; ?> </strong></div>
                                        <div><strong>200 (nombre à insérer en php)</strong> de post</div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <p> <?php echo $value['message'] ; ?> </p>
                                
                            </div>
                            <div class="card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3">
                                <div class="px-4 pt-3"> <a href="" class="text-muted d-inline-flex align-items-center align-middle" data-abc="true"> <i class="fa fa-heart text-danger"></i>&nbsp; <span class="align-middle">445</span> </a> <span class="text-muted d-inline-flex align-items-center align-middle ml-4"> <i class="fa fa-eye text-muted fsize-3"></i>&nbsp; <span class="align-middle">14532</span> </span> </div>
                                <div class="px-4 pt-3"> <button type="button" class="btn btn-primary"><i class="ion ion-md-create"></i>&nbsp; Répondre</button> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php
        }
        
        include ('../include/pages/message_form.php');
    }


    
}




?>