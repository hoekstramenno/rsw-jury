<?php

namespace App\Http\Controllers\Pdf;

use App\Models\Team;
use View;
use App\Contracts\PrintableFactoryInterface;
use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Services\FileGenerators\Pdf;
use App\Support\Factories\Printable\PdfPrintableFactory;
use Illuminate\Http\Request;

class RatingController extends Controller
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

    public function __invoke(Request $request, string $year, string $formNumber, string $suffix = '')
    {
        $rating = $this->getRating($year, $formNumber, $suffix);

        $teams = $this->getAllActiveTeamsOfYear($year);

        $printableRating = $this->printableFactory->make('pdf.rating', $rating);
        $name            = 'RSW-' . $rating->year->label . '-formulier-' . $rating->number . $rating->suffix;
        $options = [
            'orientation' => $rating->printview->view,
            'title'       => $name
        ];

        if (in_array($rating->printview->view, ['portrait', 'landscape'], true) === false) {
            $options = [
                'orientation' => 'portrait',
            ];
        }

        $printableRating->addData('teams', $teams);

//        return View::make($printableRating->getTemplateName(), ['data' => $printableRating->getData()])->render();

        return response($this->pdf->render($printableRating, $options))->withHeaders([
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => ($request->has('download') ? 'attachment' : 'inline')
                                     . "; filename='rating-{$name}.pdf'",
        ]);
    }

    /**
     * @param string $year
     * @param string $formNumber
     * @param string $suffix
     *
     * @return mixed
     */
    protected function getRating(int $year, int $formNumber, string $suffix)
    {
        return Rating::where(
            [
                'number' => $formNumber,
            ])
             ->whereHas('year', static function ($query) use ($year) {
                 $query->where('label', $year);
             })
             ->when($suffix, static function ($query, $suffix) {
                 return $query->where('suffix', $suffix);
             })
             ->with(['printView', 'year', 'ratingCategory', 'criteria', 'definitions', 'year'])
             ->firstOrFail();
    }

    /**
     * @param string $year
     *
     * @return mixed
     */
    protected function getCountOfTotalTeams(string $year)
    {
        return Team::whereHas('year', static function ($query) use ($year) {
            $query->where('label', $year);
        })->count();
    }

    /**
     * @param string $year
     *
     * @return mixed
     */
    protected function getAllActiveTeamsOfYear(string $year)
    {
        return Team::whereHas('year', static function ($query) use ($year) {
            $query->where('label', $year);
        })->where('is_active', true)->get();
    }
}
