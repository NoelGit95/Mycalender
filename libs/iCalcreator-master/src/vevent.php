<?php
/**
 * iCalcreator, the PHP class package managing iCal (rfc2445/rfc5445) calendar information.
 *
 * copyright (c) 2007-2019 Kjell-Inge Gustafsson, kigkonsult, All rights reserved
 * Link      https://kigkonsult.se
 * Package   iCalcreator
 * Version   2.26.8
 * License   Subject matter of licence is the software iCalcreator.
 *           The above copyright, link, package and version notices,
 *           this licence notice and the invariant [rfc5545] PRODID result use
 *           as implemented and invoked in iCalcreator shall be included in
 *           all copies or substantial portions of the iCalcreator.
 *
 *           iCalcreator is free software: you can redistribute it and/or modify
 *           it under the terms of the GNU Lesser General Public License as published
 *           by the Free Software Foundation, either version 3 of the License,
 *           or (at your option) any later version.
 *
 *           iCalcreator is distributed in the hope that it will be useful,
 *           but WITHOUT ANY WARRANTY; without even the implied warranty of
 *           MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *           GNU Lesser General Public License for more details.
 *
 *           You should have received a copy of the GNU Lesser General Public License
 *           along with iCalcreator. If not, see <https://www.gnu.org/licenses/>.
 *
 * This file is a part of iCalcreator.
*/

namespace Kigkonsult\Icalcreator;

use Kigkonsult\Icalcreator\Util\Util;
use function sprintf;
use function strtoupper;

/**
 * iCalcreator VEVENT component class
 *
 * @author Kjell-Inge Gustafsson, kigkonsult <ical@kigkonsult.se>
 * @since  2.26 - 2018-11-10
 */
class Vevent extends CalendarComponent
{
    use Traits\ATTACHtrait,
        Traits\ATTENDEEtrait,
        Traits\CATEGORIEStrait,
        Traits\CLASStrait,
        Traits\COMMENTtrait,
        Traits\CONTACTtrait,
        Traits\CREATEDtrait,
        Traits\DESCRIPTIONtrait,
        Traits\DTENDtrait,
        Traits\DTSTAMPtrait,
        Traits\DTSTARTtrait,
        Traits\DURATIONtrait,
        Traits\EXDATEtrait,
        Traits\EXRULEtrait,
        Traits\GEOtrait,
        Traits\LAST_MODIFIEDtrait,
        Traits\LOCATIONtrait,
        Traits\ORGANIZERtrait,
        Traits\PRIORITYtrait,
        Traits\RDATEtrait,
        Traits\RECURRENCE_IDtrait,
        Traits\RELATED_TOtrait,
        Traits\REQUEST_STATUStrait,
        Traits\RESOURCEStrait,
        Traits\RRULEtrait,
        Traits\SEQUENCEtrait,
        Traits\STATUStrait,
        Traits\SUMMARYtrait,
        Traits\TRANSPtrait,
        Traits\UIDtrait,
        Traits\URLtrait;

    /**
     * Constructor for calendar component VEVENT object
     *
     * @author Kjell-Inge Gustafsson, kigkonsult <ical@kigkonsult.se>
     * @since  2.22.20 - 2017-02-01
     * @param  array $config
     */
    public function __construct( $config = [] ) {
        static $E = 'e';
        parent::__construct();
        $this->setConfig( Util::initConfig( $config ));
        $this->cno = $E . parent::getObjectNo();
    }

    /**
     * Destructor
     *
     * @author Kjell-Inge Gustafsson, kigkonsult <ical@kigkonsult.se>
     * @since  2.26 - 2018-11-10
     */
    public function __destruct() {
        if( ! empty( $this->components )) {
            foreach( $this->components as $cix => $component ) {
                $this->components[$cix]->__destruct();
            }
        }
        unset( $this->xprop,
            $this->components,
            $this->unparsed,
            $this->config,
            $this->compix,
            $this->propix,
            $this->propdelix
        );
        unset( $this->compType,
            $this->cno,
            $this->srtk
        );
        unset( $this->attach,
            $this->attendee,
            $this->categories,
            $this->class,
            $this->comment,
            $this->contact,
            $this->created,
            $this->description,
            $this->dtend,
            $this->dtstamp,
            $this->dtstart,
            $this->duration,
            $this->exdate,
            $this->exrule,
            $this->geo,
            $this->lastmodified,
            $this->location,
            $this->organizer,
            $this->priority,
            $this->rdate,
            $this->recurrenceid,
            $this->relatedto,
            $this->requeststatus,
            $this->resources,
            $this->rrule,
            $this->sequence,
            $this->status,
            $this->summary,
            $this->transp,
            $this->uid,
            $this->url
        );
    }

    /**
     * Return formatted output for calendar component VEVENT object instance
     *
     * @author Kjell-Inge Gustafsson, kigkonsult <ical@kigkonsult.se>
     * @since  2.26 - 2018-11-10
     * @return string
     */
    public function createComponent() {
        $compType    = strtoupper( $this->compType );
        $component   = sprintf( Util::$FMTBEGIN, $compType );
        $component  .= $this->createUid();
        $component  .= $this->createDtstamp();
        $component  .= $this->createAttach();
        $component  .= $this->createAttendee();
        $component  .= $this->createCategories();
        $component  .= $this->createComment();
        $component  .= $this->createContact();
        $component  .= $this->createClass();
        $component  .= $this->createCreated();
        $component  .= $this->createDescription();
        $component  .= $this->createDtstart();
        $component  .= $this->createDtend();
        $component  .= $this->createDuration();
        $component  .= $this->createExdate();
        $component  .= $this->createExrule();
        $component  .= $this->createGeo();
        $component  .= $this->createLastModified();
        $component  .= $this->createLocation();
        $component  .= $this->createOrganizer();
        $component  .= $this->createPriority();
        $component  .= $this->createRdate();
        $component  .= $this->createRrule();
        $component  .= $this->createRelatedTo();
        $component  .= $this->createRequestStatus();
        $component  .= $this->createRecurrenceid();
        $component  .= $this->createResources();
        $component  .= $this->createSequence();
        $component  .= $this->createStatus();
        $component  .= $this->createSummary();
        $component  .= $this->createTransp();
        $component  .= $this->createUrl();
        $component  .= $this->createXprop();
        $component  .= $this->createSubComponent();
        return $component . sprintf( Util::$FMTEND, $compType );
    }

    /**
     * Return Valarm object instance, CalendarComponent::newComponent() wrapper
     *
     * @author Kjell-Inge Gustafsson, kigkonsult <ical@kigkonsult.se>
     * @since  2.26 - 2018-11-10
     * @return object
     */
    public function newValarm() {
        return $this->newComponent( self::VALARM );
    }
}
