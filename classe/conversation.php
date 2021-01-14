<?php

class Conversation {

    private $id;
    public $id_topic; 
    public $date_creation; 
    public $sujet;
    public $id_createur;
    public $id_visbilite;

    public function __construct($id_topic, $date_creation, $sujet, $id_createur, $id_visibilite)
    {
        $this->id_topic = $id_topic ;
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

        if (isset($_POST['conversation_submit'])) {

            @$sujet = htmlspecialchars($_POST['conversation_sujet']);
            date_default_timezone_set('Europe/Paris');
            @$date = date("Y-m-d H:i:s"); 
            @$id_topic = $_GET['id'];
            

            $requete_create = $this->db->prepare("INSERT INTO conversations (id_topic, date_creation, sujet, id_createur, id_visibilite) VALUES(:id_topic, :date_creation, :sujet, :id_createur, (SELECT id_visibilite FROM topics WHERE id = :id_topic))");      
            $requete_create->execute(array(
                'id_topic' => $id_topic,
                'date_creation' => $date,
                'sujet' => $sujet,
                'id_createur' => $_SESSION['user']['id']));
         }
    }


    
    public function display_conversation_public () {

        @$id_topic = $_GET['id'];
        $requete = $this->db->prepare("SELECT * FROM conversations INNER JOIN utilisateurs ON utilisateurs.id=conversations.id_createur INNER JOIN topics ON topics.id=conversations.id_topic WHERE conversations.id_topic=:id_topic AND conversations.id_visibilite = 0 ORDER BY conversations.date_creation DESC");
        $requete->execute(['id_topic' => $id_topic]);
        $conversation= $requete->fetchall();


        foreach ($conversation as $key => $value ) { 

            ?>
        
        <div class="container d-block p-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="media flex-wrap w-100 align-items-center"> <img src="../img/fuck-cat.jpg" class="d-block ui-w-40 rounded-circle" alt="">
                            <div class="media-body ml-3"> <a href="message.php?id=<?php echo $value['0']?>"><?php echo $value['3'] ?></a>
                            <hr>
                            <div class="container d-flex">
                                <div class="media-body ml-3"> <a href=""><?php echo "Posté par&nbsp". "<strong>". $value['7'] ."</strong>" ?></a>
                                    <div class="text-muted small"><?php echo "Créé le&nbsp" . $value['2'] ?></div>
                                </div>
                                <div class="text-muted small ml-3">
                                    <div>Membre depuis <strong> date en php à insérer</strong></div>
                                    <div><strong>200 (nombre à insérer en php)</strong> de post</div>
                                </div>
                                </div>
                                </div>  
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <?php    
        }
    
    }

    public function display_conversation_user () {

        @$id_topic = $_GET['id'];
        $requete = $this->db->prepare("SELECT * FROM conversations INNER JOIN utilisateurs ON utilisateurs.id=conversations.id_createur INNER JOIN topics ON topics.id=conversations.id_topic WHERE conversations.id_topic=:id_topic AND conversations.id_visibilite <= 1 ORDER BY conversations.date_creation DESC");
        $requete->execute(['id_topic' => $id_topic]);
        $conversation= $requete->fetchall();

        // create_conversation ();

        foreach ($conversation as $key => $value ) { 

            ?>
        
        <div class="container d-block p-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="media flex-wrap w-100 align-items-center"> <img src="../img/fuck-cat.jpg" class="d-block ui-w-40 rounded-circle" alt="">
                            <div class="media-body ml-3"> <a href="message.php?id=<?php echo $value['0']?>"><?php echo $value['3'] ?></a>
                            <hr>
                            <div class="container d-flex">
                                <div class="media-body ml-3"> <a href=""><?php echo "Posté par&nbsp". "<strong>". $value['7'] ."</strong>" ?></a>
                                    <div class="text-muted small"><?php echo "Créé le&nbsp" . $value['2'] ?></div>
                                </div>
                                <div class="text-muted small ml-3">
                                    <div>Membre depuis <strong> date en php à insérer</strong></div>
                                    <div><strong>200 (nombre à insérer en php)</strong> de post</div>
                                </div>
                                </div>
                                </div>  
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <?php    
        }
    
    }

    public function display_conversation_moderateur () {

        @$id_topic = $_GET['id'];
        $requete = $this->db->prepare("SELECT * FROM conversations INNER JOIN utilisateurs ON utilisateurs.id=conversations.id_createur INNER JOIN topics ON topics.id=conversations.id_topic WHERE conversations.id_topic=:id_topic AND conversations.id_visibilite <= 2 ORDER BY conversations.date_creation DESC");
        $requete->execute(['id_topic' => $id_topic]);
        $conversation= $requete->fetchall();

        // create_conversation ();

        foreach ($conversation as $key => $value ) { 

            ?>

        <div class="container d-block p-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="media flex-wrap w-100 align-items-center"> <img src="../img/fuck-cat.jpg" class="d-block ui-w-40 rounded-circle" alt="">
                            <div class="media-body ml-3"> <a href="message.php?id=<?php echo $value['0']?>"><?php echo $value['3'] ?></a>
                            <hr>
                            <div class="container d-flex">
                                <div class="media-body ml-3"> <a href=""><?php echo "Posté par&nbsp". "<strong>". $value['7'] ."</strong>" ?></a>
                                    <div class="text-muted small"><?php echo "Créé le&nbsp" . $value['2'] ?></div>
                                </div>
                                <div class="text-muted small ml-3">
                                    <div>Membre depuis <strong> date en php à insérer</strong></div>
                                    <div><strong>200 (nombre à insérer en php)</strong> de post</div>
                                </div>
                                </div>
                                </div>  
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <?php    
        }
    
    }

    public function display_conversation_admin () {

        @$id_topic = $_GET['id'];
        $requete = $this->db->prepare("SELECT * FROM conversations INNER JOIN utilisateurs ON utilisateurs.id=conversations.id_createur INNER JOIN topics ON topics.id=conversations.id_topic WHERE conversations.id_topic=:id_topic AND conversations.id_visibilite <= 3 ORDER BY conversations.date_creation DESC");
        $requete->execute(['id_topic' => $id_topic]);
        $conversation= $requete->fetchall();

        // echo "<pre>";
        // var_dump($conversation);
        // echo "</pre>";

        foreach ($conversation as $key => $value ) { 

            ?>
        
        <div class="container d-block p-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="media flex-wrap w-100 align-items-center"> <img src="../img/fuck-cat.jpg" class="d-block ui-w-40 rounded-circle" alt="">
                            <div class="media-body ml-3"> <a href="message.php?id=<?php echo $value['0']?>"><?php echo $value['3'] ?></a>
                            <hr>
                            <div class="container d-flex">
                                <div class="media-body ml-3"> <a href=""><?php echo "Posté par&nbsp". "<strong>". $value['7'] ."</strong>" ?></a>
                                    <div class="text-muted small"><?php echo "Créé le&nbsp" . $value['2'] ?></div>
                                </div>
                                <div class="text-muted small ml-3">
                                    <div>Membre depuis <strong> date en php à insérer</strong></div>
                                    <div><strong>200 (nombre à insérer en php)</strong> de post</div>
                                </div>
                                </div>
                                </div>  
                            </div>
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