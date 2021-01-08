<?php

class Conversation {

    private $id;
    public $id_topic; 
    public $id_conversation;
    public $date_creation; 
    public $sujet;
    public $id_createur;
    public $id_visbilite;

    public function __construct($id_topic, $id_conversation, $date_creation, $sujet, $id_createur, $id_visibilite)
    {
        $this->id_topic = $id_topic ;
        $this->id_conversation = $id_conversation;
        $this->date_creation = $date_creation;
        $this->sujet = $sujet;
        $this->id_createur = $id_createur;
        $this->visibilite = $id_visibilite;
        $this->db = $this->db_connexion(); 
    }

    public function db_connexion() {
        try {
            $db = new PDO("mysql:host=localhost;dbname=forum", 'root', 'root');
            $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        }
        
        catch (PDOException $e) {
            echo 'Echec de la connexion : ' . $e->getMessage();
        }
      }

    public function create_conversation () {

        include ('../include/pages/conv_form.php');

        // NE SOIT PAS TROP LARGUE
        if (isset($_POST['conversation_submit'])) {

            $sujet = htmlspecialchars($_POST['conversation_sujet']);
            $description = htmlspecialchars($_POST['conversation_description']);
            
         }

        $requete = $this->db->prepare("INSERT INTO conversations (id_topic,id_conversation,date_creation,sujet,id_createur,id_visibilite) VALUES(:id_topic,:date_creation,:sujet,:id_createur,:id_visibilite)");      
        $requete_create->execute([
            'id_topic' => $this->id_topic,
            'id_conversation' => $this->id_conversation,
            'date_creation' => $this->date_creation,
            'sujet' => $this->sujet,
            'id_createur' => $this->id_createur,
            'id_visibilite' => $this->id_visibilite
            ]);
            


            return [
            $this->id_topic,
            $this->id_conversation,
            $this->date_creation,
            $this->sujet,
            $this->id_createur,
            $this->id_visibilite,
            ];  

    }


    
    public function display_conversation_public () {

        $requete = $this->db->query("SELECT * FROM conversations INNER JOIN utilisateurs WHERE utilisateurs.id_droit<1 ORDER BY conversations.date_creation ASC");
        $conversation= $requete->fetchall();


        foreach ($conversation as $key => $value ) { 

            ?>
        
            <div class="container d-block p-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="media flex-wrap w-100 align-items-center"> <img src="../img/fuck-cat.jpg" class="d-block ui-w-40 rounded-circle" alt="">
                                <div class="media-body ml-3"> <a href=""><?php echo $value['login'] ?></a>
                                    <div class="text-muted small"><?php echo $value['date_creation'] ?></div>
                                </div>
                                <div class="text-muted small ml-3">
                                    <div>Membre depuis <strong> date en php à insérer</strong></div>
                                    <div><strong>200 (nombre à insérer en php)</strong> de post</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p> Public
                            </p>
                            <p> Miaou miaou miaou, Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou 
                            Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou  
                            </p>
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
    
    }

    public function display_conversation_user () {

        $requete = $this->db->query("SELECT * FROM conversations INNER JOIN utilisateurs WHERE utilisateurs.id_droit=0 ORDER BY conversations.date_creation ASC");
        $conversation= $requete->fetchall();

        create_conversation ();

        foreach ($conversation as $key => $value ) { 

            ?>
        
            <div class="container d-block p-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="media flex-wrap w-100 align-items-center"> <img src="../img/fuck-cat.jpg" class="d-block ui-w-40 rounded-circle" alt="">
                                <div class="media-body ml-3"> <a href=""><?php echo $value['login'] ?></a>
                                    <div class="text-muted small"><?php echo $value['date_creation'] ?></div>
                                </div>
                                <div class="text-muted small ml-3">
                                    <div>Membre depuis <strong> date en php à insérer</strong></div>
                                    <div><strong>200 (nombre à insérer en php)</strong> de post</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p> Utilisateur connecté
                            </p>
                            <p> Miaou miaou miaou, Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou 
                            Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou  
                            </p>
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
    
    }

    public function display_conversation_moderateur () {

        $requete = $this->db->query("SELECT * FROM conversations INNER JOIN utilisateurs WHERE utilisateurs.id_droit<=1 ORDER BY conversations.date_creation ASC");
        $conversation= $requete->fetchall();

        create_conversation ();

        foreach ($conversation as $key => $value ) { 

            ?>
        
            <div class="container d-block p-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="media flex-wrap w-100 align-items-center"> <img src="../img/fuck-cat.jpg" class="d-block ui-w-40 rounded-circle" alt="">
                                <div class="media-body ml-3"> <a href=""><?php echo $value['login'] ?></a>
                                    <div class="text-muted small"><?php echo $value['date_creation'] ?></div>
                                </div>
                                <div class="text-muted small ml-3">
                                    <div>Membre depuis <strong> date en php à insérer</strong></div>
                                    <div><strong>200 (nombre à insérer en php)</strong> de post</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p> Moderateur </p>
                            <p> Miaou miaou miaou, Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou 
                            Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou  
                            </p>
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
    
    }

    public function display_conversation_admin () {

        $requete = $this->db->query("SELECT * FROM conversations INNER JOIN utilisateurs WHERE utilisateurs.id_droit<=2 ORDER BY conversations.date_creation ASC");
        $conversation= $requete->fetchall();

        create_conversation ();

        foreach ($conversation as $key => $value ) { 

            ?>
        
            <div class="container d-block p-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="media flex-wrap w-100 align-items-center"> <img src="../img/fuck-cat.jpg" class="d-block ui-w-40 rounded-circle" alt="">
                                <div class="media-body ml-3"> <a href=""><?php echo $value['login'] ?></a>
                                    <div class="text-muted small"><?php echo $value['date_creation'] ?></div>
                                </div>
                                <div class="text-muted small ml-3">
                                    <div>Membre depuis <strong> date en php à insérer</strong></div>
                                    <div><strong>200 (nombre à insérer en php)</strong> de post</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>Admin 
                            </p>
                            <p> Miaou miaou miaou, Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou 
                            Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou Miaou miaou miaou  
                            </p>
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
    
    }

}
?>