<?php
/**
 * Created by Thibaud BARDIN (Irvyne)
 * This code is under the MIT License (https://github.com/Irvyne/license/blob/master/MIT.md)
 */

/**
 * Class Comment
 *
 * @Entity
 * @Table(name="comment")
 */
class Comment
{
    /**
     * @var int
     *
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @Column(type="text")
     */
    protected $content;

    /**
     * @var User
     *
     * @ManyToOne(targetEntity="User")
     */
    protected $author;

    /**
     * @var Article
     *
     * @ManyToOne(targetEntity="Article")
     */
    protected $article;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set author
     *
     * @param \User $author
     * @return Comment
     */
    public function setAuthor(\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \User 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set article
     *
     * @param \Article $article
     * @return Comment
     */
    public function setArticle(\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \Article 
     */
    public function getArticle()
    {
        return $this->article;
    }
}
