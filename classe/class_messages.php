<?php
include ('class-like-dislike.php');

class Messages extends Like_dislike{
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
            // echo $_GET['id'] ; 

            // var_dump($result) ;
    
            $requete = $this->bdd->prepare("INSERT INTO messages (id_conversations, id_topic, id_posteur, date_heure_post, message, id_visibilite)
                                                        VALUES (:id_conversations, (SELECT id_topic FROM conversations WHERE id = ".$_GET['id']."), :id_posteur, :date_heure_post, :message, :id_visibilite)
            ") ;
    
            $requete->bindParam(':id_conversations', $_GET['id']) ; 
            $requete->bindParam(':id_posteur', $_SESSION['user']['id']) ; 
            $requete->bindParam(':date_heure_post', $date) ;
            $requete->bindParam(':message',$message) ;
            $requete->bindParam(':id_visibilite',$result['id_visibilite']) ;
    
            $requete->execute(); 
            
        }

    }

    public function afficheMessagesPublic()
    {
       
        $requete = $this->bdd->prepare("SELECT messages.id,message,date_heure_post,login,avatar 
                                                FROM messages 
                                                    INNER JOIN utilisateurs
                                                        ON messages.id_posteur = utilisateurs.id 
                                                            INNER JOIN conversations 
                                                                    ON conversations.id = messages.id_conversations
                                                                        WHERE conversations.id = :id
                                                                                AND messages.id_visibilite = 0
                                                                                    ORDER BY date_heure_post ASC
        ");

        $requete->bindParam(':id', $_GET['id']) ;
        $requete->execute(); 

        $result = $requete->fetchAll();

       


        $id_user = NULL ;
        foreach($result as $key => $value)
        {

            ?>
            <div class="container d-block p-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">

                            <div class="card-header">
                            <div class="media flex-wrap w-100 align-items-center"> <div class="container w-25 h-25 ml-0"><img src="../img/avatars/<?php echo $value['avatar'] ?>" class="d-block ui-w-40 rounded-circle " alt="avatar"></div>
                                    <div class="media-body ml-3"> <a href="display_profil.php"><?= $value['login'] ; ?></a>
                                    </div>
                                    <div class="text-muted small ml-3">
                                        <div> Posté le <strong> <?= $value['date_heure_post'] ; ?> </strong></div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <p> <?= $value['message'] ; ?> </p>
                                
                            </div>
                            <div class="card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3">
                                <div class="px-4 pt-3">
                                    <a href="" class="text-muted d-inline-flex align-items-center align-middle" data-abc="true">
                                            <?php $id = $value['0']; parent::affiche_bouton_sans_like_ni_dislike($id_user, $id);        
                                                                    parent::affiche_bouton_avec_like($id_user, $id);
                                                                    parent::affiche_bouton_avec_dislike($id_user, $id);
                                            ?> 
                                    </a>       
                                </div>
                                <div class="px-4 pt-3"> <button type="button" class="btn btn-primary"><i class="ion ion-md-create"></i>&nbsp; Répondre</button> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php
        }
        
        echo '<div class="container d-block p-5">
                    <div class="row">
                        <div class="col-md-12">
                            <p id="mess_error_repondre_liker" class="error text-center"> Vous devez être connecter pour pouvoir répondre et liker </p></div>
                     </div>
                </div>' ;  

    }

    public function afficheMessagesConnect()
    {
      
        $requete = $this->bdd->prepare("SELECT messages.id,message,date_heure_post,login,avatar 
                                                FROM messages 
                                                    INNER JOIN utilisateurs
                                                        ON messages.id_posteur = utilisateurs.id 
                                                            INNER JOIN conversations 
                                                                    ON conversations.id = messages.id_conversations
                                                                        WHERE conversations.id = :id
                                                                                AND messages.id_visibilite <= 1
                                                                                    ORDER BY date_heure_post ASC
        ");
        
        $requete->bindParam(':id', $_GET['id']) ;
        $requete->execute(); 



        $result = $requete->fetchAll();

        $id_user = $_SESSION['user']['id'] ;
        foreach($result as $key => $value)
        {
            ?>
            <div class="container d-block p-5<?php if($_SESSION['user']['login'] == $value['login']){ echo ' message_connect' ; } ?>" id="<?=$value['id']?>">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">

                            <div class="card-header">
                                <div class="media flex-wrap w-100 align-items-center"> <div class="container w-25 h-25 ml-0"><img src="../img/avatars/<?php echo $value['avatar'] ?>" class="d-block ui-w-40 rounded-circle w-100 h-100" alt="avatar"></div>
                                    <div class="media-body ml-3"> <a href="display_profil.php"><?php echo $value['login'] ; ?></a>
                                    </div>
                                    <div class="text-muted small ml-3">
                                        <div>Posté le <strong> <?= $value['date_heure_post'] ; ?> </strong></div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <p> <?php echo $value['message'] ; ?> </p>
                                
                            </div>
                            <div class="card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3">
                                <div class="px-4 pt-3">
                                    <a href="" class="text-muted d-inline-flex align-items-center align-middle" data-abc="true">
                                            <?php $id = $value['0']; parent::affiche_bouton_sans_like_ni_dislike($id_user, $id);        
                                                                    parent::affiche_bouton_avec_like($id_user, $id);
                                                                    parent::affiche_bouton_avec_dislike($id_user, $id);
                                            ?> 
                                    </a>       
                                </div>
                                <div class="px-4 pt-3"> <a href="message.php?id=<?=$_GET['id'];?>#reponse"><button type="button" class="btn btn-primary"><i class="ion ion-md-create"></i>&nbsp; Répondre</button></a> </div>
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
        $requete = $this->bdd->prepare("SELECT messages.id,message,date_heure_post,login,avatar 
                                                FROM messages 
                                                    INNER JOIN utilisateurs
                                                        ON messages.id_posteur = utilisateurs.id 
                                                            INNER JOIN conversations 
                                                                    ON conversations.id = messages.id_conversations
                                                                        WHERE conversations.id = :id
                                                                                AND messages.id_visibilite <= 2
                                                                                    ORDER BY date_heure_post ASC
        ");

        $requete->bindParam(':id', $_GET['id']) ; 
        $requete->execute(); 

        $result = $requete->fetchAll();
        $id_user = $_SESSION['user']['id'] ;
        foreach($result as $key => $value)
        {
            ?>
            <div class="container d-block p-5<?php if($_SESSION['user']['login'] == $value['login']){ echo ' message_connect' ; } ?>"  id="<?=$value['id']?>">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">

                            <div class="card-header">
                                <div class="media flex-wrap w-100 align-items-center"> <div class="container w-25 h-25 ml-0"><img src="../img/avatars/<?php echo $value['avatar'] ?>" class="d-block ui-w-40 rounded-circle w-100 h-100" alt="avatar"></div>
                                    <div class="media-body ml-3"> <a href="display_profil.php"><?php echo $value['login'] ; ?></a>                      
                                    </div>
                                    <div class="text-muted small ml-3">
                                        <div>Posté le <strong> <?= $value['date_heure_post'] ; ?> </strong></div>
                                        <div ><a class="text-danger" href="supprimer_message_confirm.php?id=<?php echo $value['id'];?>">Supprimer le message</a></div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <p> <?php echo $value['message'] ; ?> </p>
                                
                            </div>
                            <div class="card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3">
                                <div class="px-4 pt-3">
                                <a href="" class="text-muted d-inline-flex align-items-center align-middle" data-abc="true">
                                            <?php $id = $value['0'];$_SESSION['id_message'] = $id;     parent::affiche_bouton_sans_like_ni_dislike($id_user, $id);        
                                                                        parent::affiche_bouton_avec_like($id_user, $id);
                                                                       parent::affiche_bouton_avec_dislike($id_user, $id);
                                            ?> 
                                    </a>                                    </div>
                                    <div class="px-4 pt-3"> <a href="message.php?id=<?=$_GET['id'];?>#reponse"><button type="button" class="btn btn-primary"><i class="ion ion-md-create"></i>&nbsp; Répondre</button></a> </div>
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
        $requete = $this->bdd->prepare("SELECT messages.id,message,date_heure_post,login,avatar
                                                FROM messages 
                                                    INNER JOIN utilisateurs
                                                        ON messages.id_posteur = utilisateurs.id 
                                                            INNER JOIN conversations 
                                                                    ON conversations.id = messages.id_conversations
                                                                        WHERE conversations.id = :id
                                                                                AND messages.id_visibilite <= 3
                                                                                    ORDER BY date_heure_post ASC
        ");
      
        $requete->bindParam(':id', $_GET['id']) ; 
        $requete->execute(); 

        $result = $requete->fetchAll();

        
        $id_user = $_SESSION['user']['id'] ;
        foreach($result as $key => $value)
        {
            ?>
            <div class="container d-block p-5<?php if($_SESSION['user']['login'] == $value['login']){ echo ' message_connect' ; } ?>"  id="<?=$value['id']?>">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">

                            <div class="card-header">
                                <div class="media flex-wrap w-100 align-items-center"> <div class="container w-25 h-25 ml-0"><img src="../img/avatars/<?php echo $value['avatar'] ?>" class="d-block ui-w-40 rounded-circle w-100 h-100" alt="avatar"></div>
                                    <div class="media-body ml-3"> <a href="display_profil.php"><?php echo $value['login'] ; ?></a>
                                    </div>
                                    <div class="text-muted small ml-3">
                                        <div>Posté le <strong> <?= $value['date_heure_post'] ; ?> </strong></div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <p> <?php echo $value['message'] ; ?> </p>
                                
                            </div>
                            <div class="card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3">
                                <div class="px-4 pt-3"> 
                                <a href="" class="text-muted d-inline-flex align-items-center align-middle" data-abc="true">
                                            <?php $id = $value['0'];$_SESSION['id_message'] = $id; parent::affiche_bouton_sans_like_ni_dislike($id_user, $id);        
                                                                    parent::affiche_bouton_avec_like($id_user, $id);
                                                                    parent::affiche_bouton_avec_dislike($id_user, $id);
                                            ?> 
                                    </a>                                  </div>
                                <div class="px-4 pt-3"> <a href="message.php?id=<?=$_GET['id'];?>#reponse"><button type="button" class="btn btn-primary"><i class="ion ion-md-create"></i>&nbsp; Répondre</button></a> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php
        }
        
        include ('../include/pages/message_form.php');
    }

    public function supprimer_message() 
    {
        $requete = $this->bdd->prepare("DELETE FROM messages WHERE id = :id") ; 

        $requete->bindParam(':id' , $_GET['id']) ; 

        $requete->execute(); 
    }

    public function recupIdconv()
    {
        $requete = $this->bdd->prepare("SELECT id_conversations FROM messages WHERE id = :id") ; 
        $requete->bindParam(':id', $_GET['id']); 
   
        $requete->execute(); 
   
        $result = $requete->fetch(); 
   
        $_GET['id_conv'] = $result['id_conversations'] ;

        return $_GET['id_conv'] ; 
        
    }


    
}




?>