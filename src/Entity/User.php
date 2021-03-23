<?php

namespace App\Entity;

use App\Entity\Base\ActiveEntity;
use App\Entity\Base\CreatedAtEntity;
use App\Entity\Base\DeletedAtEntity;
use App\Entity\Base\UpdatedAtEntity;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(
 *  name="`user`", 
 *  indexes={
 *      @ORM\Index(name="IDX_user_login_password", columns={"login", "password", "is_active"}),
 *      @ORM\Index(name="IDX_user_email_password", columns={"email", "password", "is_active"}),
 *      @ORM\Index(name="IDX_user_login_email_password", columns={"login", "email", "password", "is_active"}),
 *      @ORM\Index(name="IDX_user_email_login_password", columns={"email", "login", "password", "is_active"}),
 *      @ORM\Index(name="IDX_user_login_email", columns={"login", "email", "is_active"}),
 *      @ORM\Index(name="IDX_user_email_login_", columns={"email", "login", "is_active"})
 *  }
 * )
 * @ORM\HasLifecycleCallbacks()
 */
class User implements UserInterface
{
    use CreatedAtEntity;
    use UpdatedAtEntity;
    use DeletedAtEntity;
    use ActiveEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=UserType::class)
     */
    private $userType;

    /**
     * @ORM\Column(type="string", length=150, unique=true)
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=150, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $password = '123';

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $gender;

    /**
     * @ORM\ManyToOne(targetEntity=CompanyType::class)
     */
    private $companyType;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $lastname;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthdate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $birthplace;

    /**
     * @ORM\ManyToOne(targetEntity=Nationality::class)
     */
    private $nationality;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $zipcode;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $town;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class)
     */
    private $country;

    /**
     * @ORM\ManyToOne(targetEntity=Language::class)
     */
    private $language;

    /**
     * @ORM\ManyToOne(targetEntity=Asset::class)
     */
    private $avatar;

    /**
     * @ORM\ManyToOne(targetEntity=Asset::class)
     */
    private $banner;

    /**
     * @ORM\OneToMany(targetEntity=UserFavorite::class, mappedBy="owner")
     */
    private $userFavorites;

    /**
     * @ORM\OneToMany(targetEntity=UserDestination::class, mappedBy="owner")
     */
    private $userDestinations;

    /**
     * @ORM\OneToMany(targetEntity=UserMotivation::class, mappedBy="owner")
     */
    private $userMotivations;

    /**
     * @ORM\OneToMany(targetEntity=UserAttachment::class, mappedBy="owner")
     */
    private $userAttachments;

    /**
     * @ORM\OneToMany(targetEntity=Proposal::class, mappedBy="owner")
     */
    private $proposals;

    /**
     * @ORM\OneToMany(targetEntity=ProposalFavorite::class, mappedBy="owner")
     */
    private $proposalFavorites;

    /**
     * @ORM\OneToMany(targetEntity=Applier::class, mappedBy="owner")
     */
    private $appliers;

    /**
     * @ORM\OneToMany(targetEntity=Training::class, mappedBy="owner")
     */
    private $trainings;

    /**
     * @ORM\OneToMany(targetEntity=LanguageKnowledge::class, mappedBy="owner")
     */
    private $languageKnowledges;

    /**
     * @ORM\OneToMany(targetEntity=Experience::class, mappedBy="owner")
     * @ORM\OrderBy({"start" = "DESC", "end" = "DESC"})
     */
    private $experiences;

    /**
     * @ORM\OneToMany(targetEntity=Other::class, mappedBy="owner")
     */
    private $others;

    /**
     * @ORM\OneToOne(targetEntity=UserStat::class, mappedBy="owner", cascade={"persist", "remove"})
     */
    private $userStat;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    private $qualities;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    private $interests;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avatarPath;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bannerPath;

    public function __construct()
    {
        $this->userFavorites = new ArrayCollection();
        $this->userDestinations = new ArrayCollection();
        $this->userMotivations = new ArrayCollection();
        $this->userAttachments = new ArrayCollection();
        $this->proposals = new ArrayCollection();
        $this->proposalFavorites = new ArrayCollection();
        $this->appliers = new ArrayCollection();
        $this->trainings = new ArrayCollection();
        $this->languageKnowledges = new ArrayCollection();
        $this->experiences = new ArrayCollection();
        $this->others = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserType(): ?UserType
    {
        return $this->userType;
    }

    public function setUserType(?UserType $userType): self
    {
        $this->userType = $userType;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getGender(): ?int
    {
        return $this->gender;
    }

    public function setGender(?int $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getCompanyType(): ?CompanyType
    {
        return $this->companyType;
    }

    public function setCompanyType(?CompanyType $company): self
    {
        $this->companyType = $company;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(?\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getBirthplace(): ?string
    {
        return $this->birthplace;
    }

    public function setBirthplace(?string $birthplace): self
    {
        $this->birthplace = $birthplace;

        return $this;
    }

    public function getNationality(): ?Nationality
    {
        return $this->nationality;
    }

    public function setNationality(?Nationality $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(?string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getTown(): ?string
    {
        return $this->town;
    }

    public function setTown(?string $town): self
    {
        $this->town = $town;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getLanguage(): ?Language
    {
        return $this->language;
    }

    public function setLanguage(?Language $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function getAvatar(): ?Asset
    {
        return $this->avatar;
    }

    public function setAvatar(?Asset $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getBanner(): ?Asset
    {
        return $this->banner;
    }

    public function setBanner(?Asset $banner): self
    {
        $this->banner = $banner;

        return $this;
    }

    /**
     * @return Collection|UserFavorite[]
     */
    public function getUserFavorites(): Collection
    {
        return $this->userFavorites;
    }

    public function addUserFavorite(UserFavorite $userFavorite): self
    {
        if (!$this->userFavorites->contains($userFavorite)) {
            $this->userFavorites[] = $userFavorite;
            $userFavorite->setOwner($this);
        }

        return $this;
    }

    public function removeUserFavorite(UserFavorite $userFavorite): self
    {
        if ($this->userFavorites->removeElement($userFavorite)) {
            // set the owning side to null (unless already changed)
            if ($userFavorite->getOwner() === $this) {
                $userFavorite->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserDestination[]
     */
    public function getUserDestinations(): Collection
    {
        return $this->userDestinations;
    }

    public function addUserDestination(UserDestination $userDestination): self
    {
        if (!$this->userDestinations->contains($userDestination)) {
            $this->userDestinations[] = $userDestination;
            $userDestination->setOwner($this);
        }

        return $this;
    }

    public function removeUserDestination(UserDestination $userDestination): self
    {
        if ($this->userDestinations->removeElement($userDestination)) {
            // set the owning side to null (unless already changed)
            if ($userDestination->getOwner() === $this) {
                $userDestination->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserMotivation[]
     */
    public function getUserMotivations(): Collection
    {
        return $this->userMotivations;
    }

    public function addUserMotivation(UserMotivation $userMotivation): self
    {
        if (!$this->userMotivations->contains($userMotivation)) {
            $this->userMotivations[] = $userMotivation;
            $userMotivation->setOwner($this);
        }

        return $this;
    }

    public function removeUserMotivation(UserMotivation $userMotivation): self
    {
        if ($this->userMotivations->removeElement($userMotivation)) {
            // set the owning side to null (unless already changed)
            if ($userMotivation->getOwner() === $this) {
                $userMotivation->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * Get the User Motivation
     *
     * @return UserMotivation
     */
    public function getUserMotivation(): UserMotivation
    {
        $motivations = $this->getUserMotivations();

        return $motivations->first() ? $motivations->first() : (new UserMotivation())->setOwner($this);
    }

    /**
     * @return Collection|UserAttachment[]
     */
    public function getUserAttachments(): Collection
    {
        return $this->userAttachments;
    }

    public function addUserAttachment(UserAttachment $userAttachment): self
    {
        if (!$this->userAttachments->contains($userAttachment)) {
            $this->userAttachments[] = $userAttachment;
            $userAttachment->setOwner($this);
        }

        return $this;
    }

    public function removeUserAttachment(UserAttachment $userAttachment): self
    {
        if ($this->userAttachments->removeElement($userAttachment)) {
            // set the owning side to null (unless already changed)
            if ($userAttachment->getOwner() === $this) {
                $userAttachment->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Proposal[]
     */
    public function getProposals(): Collection
    {
        return $this->proposals;
    }

    public function addProposal(Proposal $proposal): self
    {
        if (!$this->proposals->contains($proposal)) {
            $this->proposals[] = $proposal;
            $proposal->setOwner($this);
        }

        return $this;
    }

    public function removeProposal(Proposal $proposal): self
    {
        if ($this->proposals->removeElement($proposal)) {
            // set the owning side to null (unless already changed)
            if ($proposal->getOwner() === $this) {
                $proposal->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ProposalFavorite[]
     */
    public function getProposalFavorites(): Collection
    {
        return $this->proposalFavorites;
    }

    public function addProposalFavorite(ProposalFavorite $proposalFavorite): self
    {
        if (!$this->proposalFavorites->contains($proposalFavorite)) {
            $this->proposalFavorites[] = $proposalFavorite;
            $proposalFavorite->setOwner($this);
        }

        return $this;
    }

    public function removeProposalFavorite(ProposalFavorite $proposalFavorite): self
    {
        if ($this->proposalFavorites->removeElement($proposalFavorite)) {
            // set the owning side to null (unless already changed)
            if ($proposalFavorite->getOwner() === $this) {
                $proposalFavorite->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Applier[]
     */
    public function getAppliers(): Collection
    {
        return $this->appliers;
    }

    public function addApplier(Applier $applier): self
    {
        if (!$this->appliers->contains($applier)) {
            $this->appliers[] = $applier;
            $applier->setOwner($this);
        }

        return $this;
    }

    public function removeApplier(Applier $applier): self
    {
        if ($this->appliers->removeElement($applier)) {
            // set the owning side to null (unless already changed)
            if ($applier->getOwner() === $this) {
                $applier->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Training[]
     */
    public function getTrainings(): Collection
    {
        return $this->trainings;
    }

    public function addTraining(Training $training): self
    {
        if (!$this->trainings->contains($training)) {
            $this->trainings[] = $training;
            $training->setOwner($this);
        }

        return $this;
    }

    public function removeTraining(Training $training): self
    {
        if ($this->trainings->removeElement($training)) {
            // set the owning side to null (unless already changed)
            if ($training->getOwner() === $this) {
                $training->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|LanguageKnowledge[]
     */
    public function getLanguageKnowledges(): Collection
    {
        return $this->languageKnowledges;
    }

    public function addLanguageKnowledge(LanguageKnowledge $languageKnowledge): self
    {
        if (!$this->languageKnowledges->contains($languageKnowledge)) {
            $this->languageKnowledges[] = $languageKnowledge;
            $languageKnowledge->setOwner($this);
        }

        return $this;
    }

    public function removeLanguageKnowledge(LanguageKnowledge $languageKnowledge): self
    {
        if ($this->languageKnowledges->removeElement($languageKnowledge)) {
            // set the owning side to null (unless already changed)
            if ($languageKnowledge->getOwner() === $this) {
                $languageKnowledge->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Experience[]
     */
    public function getExperiences(): Collection
    {
        return $this->experiences;
    }

    public function addExperience(Experience $experience): self
    {
        if (!$this->experiences->contains($experience)) {
            $this->experiences[] = $experience;
            $experience->setOwner($this);
        }

        return $this;
    }

    public function removeExperience(Experience $experience): self
    {
        if ($this->experiences->removeElement($experience)) {
            // set the owning side to null (unless already changed)
            if ($experience->getOwner() === $this) {
                $experience->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Other[]
     */
    public function getOthers(): Collection
    {
        return $this->others;
    }

    public function addOther(Other $other): self
    {
        if (!$this->others->contains($other)) {
            $this->others[] = $other;
            $other->setOwner($this);
        }

        return $this;
    }

    public function removeOther(Other $other): self
    {
        if ($this->others->removeElement($other)) {
            // set the owning side to null (unless already changed)
            if ($other->getOwner() === $this) {
                $other->setOwner(null);
            }
        }

        return $this;
    }

    public function getUserStat(): ?UserStat
    {
        return $this->userStat;
    }

    public function setUserStat(UserStat $userStat): self
    {
        $this->userStat = $userStat;

        // set the owning side of the relation if necessary
        if ($userStat->getOwner() !== $this) {
            $userStat->setOwner($this);
        }

        return $this;
    }

    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return ['ROLE_USER'];
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return string[] The user roles
     */
    public function getRoles()
    {
        $userType = $this->getUserType();
        if (UserType::ADMIN == $userType->getId()) {
            return ['ROLE_ADMIN'];
        } elseif (UserType::CANDIDAT == $userType->getId()) {
            return ['ROLE_USER'];
        } elseif (UserType::COMPANY == $userType->getId()) {
            return ['ROLE_COMPANY'];
        }
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->login;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        //
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getQualities(): ?string
    {
        return $this->qualities;
    }

    public function setQualities(?string $qualities): self
    {
        $this->qualities = $qualities;

        return $this;
    }

    public function getInterests(): ?string
    {
        return $this->interests;
    }

    public function setInterests(?string $interests): self
    {
        $this->interests = $interests;

        return $this;
    }

    public function getAvatarPath(): ?string
    {
        return $this->avatarPath;
    }

    public function setAvatarPath(?string $avatarPath): self
    {
        $this->avatarPath = $avatarPath;

        return $this;
    }

    public function getBannerPath(): ?string
    {
        return $this->bannerPath;
    }

    public function setBannerPath(?string $bannerPath): self
    {
        $this->bannerPath = $bannerPath;

        return $this;
    }
}
