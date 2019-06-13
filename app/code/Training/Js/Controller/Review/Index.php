<?php
namespace Training\Js\Controller\Review;


class Index extends \Magento\Framework\App\Action\Action
{
    protected $jsonResultFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $jsonResultFactory
    ) {
        $this->jsonResultFactory = $jsonResultFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $result = $this->jsonResultFactory->create();
        $result->setData($this->getRandomReviewData());
        return $result;
    }

    private function getRandomReviewData()
    {
        $reviews = [
            [
                'name' => 'Reviewer 1',
                'message' => 'Lorem ipsum dolor sit amet, atqui audiam et ius, te eum sanctus ancillae forensibus. 
                    Sanctus phaedrum reprehendunt ea has. No eos odio eloquentiam, id natum deterruisset qui, atqui antiopam ad usu. 
                    Ex aeque torquatos nam. Reprimique percipitur ad pro, eum consequat gloriatur ei. Mei an ullum ceteros scripserit, perfecto patrioque at has.'
            ],
            [
                'name' => 'Reviewer 2',
                'message' => 'Option disputando ius eu, eum an euripidis laboramus interpretaris, utamur probatus vim at. 
                    Usu elitr doming at, mea no cibo soluta. Simul postulant repudiandae eam cu, sumo malorum adipisci ex sea, 
                    ex decore propriae imperdiet sed. Vix no lobortis philosophia, eam cu inani iusto complectitur. 
                    Vim solum delicata petentium an. Vel te unum laboramus, erat incorrupte pro ut.'
            ],
            [
                'name' => 'Reviewer 3',
                'message' => 'Duo ne quod nemore oporteat. Aeque evertitur sea ex, liber periculis disputando usu ne. 
                    Cu nec idque ignota, cu tollit timeam volutpat mea. Iusto veritus neglegentur id mei, sed an porro quaestio.'
            ],
            [
                'name' => 'Reviewer 4',
                'message' => 'Accusam petentium id his, semper consequuntur eu vis. 
                    Id mea enim nonumy consectetuer, convenire consetetur definitiones et est. 
                    Detracto maluisset id est, eum id vidit utroque perpetua. Ne nam saepe recteque. 
                    Sit graece oblique ut, qui integre vituperata temporibus ne. An fugit populo vis, quo dictas blandit persecuti ut, eu ius meis senserit.'
            ]

        ];
        return $reviews[rand(0,3)];
    }
}
