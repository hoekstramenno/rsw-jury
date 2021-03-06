<?php

namespace App\Http\Controllers;

use App\Contracts\PrintableFactoryInterface;
use App\Models\Rating;
use App\Models\Team;
use App\Services\FileGenerators\Pdf;
use App\Support\Factories\Printable\PdfPrintableFactory;
use App\Support\Result\TotalScore;
use Illuminate\Support\Collection;

class ResultController extends Controller
{
    /**
     * The pdf instance.
     *
     * @var Pdf
     */
    protected $pdf;

    /**
     * @var PrintableFactoryInterface
     */
    protected $printableFactory;

    public function __construct(Pdf $pdf, PdfPrintableFactory $printableFactory)
    {
        $this->pdf              = $pdf;
        $this->printableFactory = $printableFactory;
    }

    public function index(int $year)
    {
        /** @var Collection $ratings */
        $ratings = Rating::inYear($year)->where('outside_competition', false)->get();
        $teams   = Team::inYear($year)->where('is_active', true)->with(['scores.rating', 'group'])->get();
        $scores  = (new TotalScore($teams))->sortByTotalScore();

        return view(
            'pages.results.index',
            [
                'ratings' => $ratings,
                'teams'   => $teams,
                'scores'  => $scores,
                'total'   => $this->calculateTotalScoreForRatings($ratings),
            ]
        );
    }

    public function pdf(int $year)
    {
        /** @var Collection $ratings */
        $ratings = Rating::inYear($year)->where('outside_competition', false)->get();
        $teams   = Team::inYear($year)->where('is_active', true)->with(['scores', 'group'])->get();
        $scores  = (new TotalScore($teams))->sortByTotalScore();

        $printableRating = $this->printableFactory->make(
            'pdf.result',
            collect(
                [
                    'ratings' => $ratings,
                    'total'   => $this->calculateTotalScoreForRatings($ratings),
                    'teams'   => $teams,
                    'scores'  => $scores,
                ]
            )
        );

        $name    = 'RSW-' . $year . '-eind-uitslag';
        $options = [
            'orientation' => 'landscape',
            'title'       => $name,
        ];

        return response($this->pdf->render($printableRating, $options))->withHeaders(
            [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => 'inline' . "; filename='rating-{$name}.pdf'",
            ]
        );
    }

    /**
     * @param  \Illuminate\Support\Collection  $ratings
     * @return int
     */
    protected function calculateTotalScoreForRatings(Collection $ratings): int
    {
        return array_reduce(
            $ratings->toArray(),
            function ($carry, $rating) {
                return $carry + ($rating['points'] * $rating['factor']);
            },
            0
        );
    }
}
