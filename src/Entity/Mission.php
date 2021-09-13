<?php

namespace App\Entity;

use App\Repository\MissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MissionRepository::class)
 */
class Mission
{
    public  $errors = [];
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codeName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country;

    /**
     * @ORM\ManyToMany(targetEntity=Agent::class, inversedBy="missions")
     */
    private $agents;

    /**
     * @ORM\ManyToMany(targetEntity=Contact::class, inversedBy="missions")
     */
    private $contacts;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\ManyToMany(targetEntity=Place::class, inversedBy="missions")
     */
    private $places;

    /**
     * @ORM\ManyToOne(targetEntity=Skill::class, inversedBy="missions")
     */
    private $skill;

    /**
     * @ORM\Column(type="date")
     */
    private $date_start;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_end;

    /**
     * @ORM\ManyToMany(targetEntity=Target::class, inversedBy="missions")
     */
    private $targets;

    public function __construct()
    {
        $this->agents = new ArrayCollection();
        $this->contacts = new ArrayCollection();
        $this->places = new ArrayCollection();
        $this->targets = new ArrayCollection();
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function addErrors($error): self
    {
        $this->errors[] = $error;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCodeName(): ?string
    {
        return $this->codeName;
    }

    public function setCodeName(string $codeName): self
    {
        $this->codeName = $codeName;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection|Agent[]
     */
    public function getAgents(): Collection
    {
        return $this->agents;
    }

    public function addAgent(Agent $agent): self
    {
        if (!$this->agents->contains($agent)) {
            $this->agents[] = $agent;
        }

        return $this;
    }

    public function removeAgent(Agent $agent): self
    {
        $this->agents->removeElement($agent);

        return $this;
    }

    /**
     * @return Collection|Contact[]
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        $this->contacts->removeElement($contact);

        return $this;
    }


    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|Place[]
     */
    public function getPlaces(): Collection
    {
        return $this->places;
    }

    public function addPlace(Place $place): self
    {
        if (!$this->places->contains($place)) {
            $this->places[] = $place;
        }

        return $this;
    }

    public function removePlace(Place $place): self
    {
        $this->places->removeElement($place);

        return $this;
    }

    public function getSkill(): ?Skill
    {
        return $this->skill;
    }

    public function setSkill(?Skill $skill): self
    {
        $this->skill = $skill;

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->date_start;
    }

    public function setDateStart(\DateTimeInterface $date_start): self
    {
        $this->date_start = $date_start;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->date_end;
    }

    public function setDateEnd(?\DateTimeInterface $date_end): self
    {
        $this->date_end = $date_end;

        return $this;
    }

    /**
     * @return Collection|Target[]
     */
    public function getTargets(): Collection
    {
        return $this->targets;
    }

    public function addTarget(Target $target): self
    {
        if (!$this->targets->contains($target)) {
            $this->targets[] = $target;
        }

        return $this;
    }

    public function removeTarget(Target $target): self
    {
        $this->targets->removeElement($target);

        return $this;
    }

    public function targetIsValid():bool
    {
        $agents = $this->agents;
        $targets = $this->targets;

        foreach ($targets as $target){
            foreach ($agents as $agent){
                if ($agent->getNationality() == $target->getNationality()){
                    var_dump($agent->getFirstName());
                    $error = 'La cible ne doit pas être de la même nationalité que le ou les agents positionné(s) sur cette mission ';
                    $this->addErrors($error);
                    return false;
                }
            }
        }
        return true;
    }

    public function contactIsValid():bool
    {
        $contacts = $this->contacts;
        $country = $this->country;

        foreach ($contacts as $contact){
            if ($country != $contact->getNationality()){
                $error = 'Le ou les contact(s) doivent être du même pays que la mission actuelle';
                $this->addErrors($error);
                return false;
            }
        }
        return true;
    }

    public function placeIsValid():bool
    {
        $places = $this->places;
        $country = $this->country;

        foreach ($places as $place){
            if ($country != $place->getCountry()){
                $error = 'La planque doit être dans le même pays que la mission actuelle';
                $this->addErrors($error);
                return false;
            }
        }
        return true;
    }

    public function agentIsValid():bool
    {
        $skill = $this->skill;
        $agents = $this->agents;
        $skillsAgent = 0;
        foreach ($agents as $agent){
            $agentSkills = $agent->displaySkillsInArray();
                if (in_array($skill->getName(), $agentSkills)){
                    $skillsAgent += 1;
                }
                if ($skillsAgent == 0){
                    $error = 'La spécialité requise n\'est pas une des spécialité de ou des agent(s) selectionné(s)';
                    $this->addErrors($error);
                    return false;
                }
        }
        return true;
    }

    public function isValid():bool
    {
        if (!$this->targetIsValid()  || !$this->contactIsValid() || !$this->placeIsValid() || !$this->agentIsValid()){
            return false;
        }
        return true;
    }

    /*public function isValid()
    {
        if (!$this->targetIsValid()) {
            if (!$this->contactIsValid()){
                if (!$this->placeIsValid()){
                    if (!$this->agentIsValid()){
                        return false;
                    }
                }
            }
        }
    }*/

    public function test():bool
    {
        return true;
    }


}
